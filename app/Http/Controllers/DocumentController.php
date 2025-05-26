<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }

    public function index(Request $req)
    {
        $query = Document::with('category')->where('user_id',Auth::id());
        if ($req->filled('category')) {
            $query->where('category_id',$req->category);
        }
        $documents  = $query->paginate(10);
        $categories = Category::where('user_id',Auth::id())->get();
        return view('documents.index',compact('documents','categories'));
    }

    public function create()
    {
        $categories = Category::where('user_id',Auth::id())->get();
        return view('documents.create',compact('categories'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'title'       => 'required|string|max:255',
            'file'        => 'required|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:10240',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        // Simpan ke storage/app/public/documents untuk bisa diakses via URL
        $path = $req->file('file')->store('documents', 'public');
        
        Document::create([
            'title'       => $data['title'],
            'filename'    => $req->file('file')->getClientOriginalName(),
            'path'        => $path,
            'user_id'     => Auth::id(),
            'category_id' => $data['category_id'],
        ]);
        return redirect()->route('documents.index')
                         ->with('success','Dokumen berhasil di-upload.');
    }

    // Method baru untuk melihat dokumen
    public function show(Document $document)
    {
        $this->authorize('view', $document);
        
        // Cek apakah file ada
        if (!Storage::disk('public')->exists($document->path)) {
            abort(404, 'File tidak ditemukan');
        }
        
        $filePath = storage_path('app/public/' . $document->path);
        $fileExtension = pathinfo($document->filename, PATHINFO_EXTENSION);
        
        // Tentukan content type berdasarkan ekstensi
        $contentType = $this->getContentType($fileExtension);
        
        return Response::file($filePath, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . $document->filename . '"'
        ]);
    }

    // Method untuk download dokumen
    public function download(Document $document)
    {
        $this->authorize('view', $document);
        
        if (!Storage::disk('public')->exists($document->path)) {
            abort(404, 'File tidak ditemukan');
        }
        
        return Storage::disk('public')->download($document->path, $document->filename);
    }

    public function edit(Document $document)
    {
        $this->authorize('update',$document);
        $categories = Category::where('user_id',Auth::id())->get();
        return view('documents.edit',compact('document','categories'));
    }

    public function update(Request $req, Document $document)
    {
        $this->authorize('update',$document);
        $data = $req->validate([
            'title'       => 'required|string|max:255',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:10240',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        if ($req->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($document->path);
            
            // Upload file baru
            $newPath = $req->file('file')->store('documents', 'public');
            $document->update([
                'filename' => $req->file('file')->getClientOriginalName(),
                'path'     => $newPath,
            ]);
        }
        
        $document->update([
            'title'       => $data['title'],
            'category_id' => $data['category_id'],
        ]);
        
        return redirect()->route('documents.index')
                         ->with('success','Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete',$document);
        
        // Hapus file dari storage
        Storage::disk('public')->delete($document->path);
        
        // Hapus record dari database
        $document->delete();
        
        return redirect()->route('documents.index')
                         ->with('success','Dokumen berhasil dihapus.');
    }

    // Helper method untuk content type
    private function getContentType($extension)
    {
        $contentTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'txt' => 'text/plain',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
        ];

        return $contentTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}