<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }

    public function index(Request $req)
    {
        $q = ActivityLog::with('user');
        if ($req->filled('user_id')) { $q->where('user_id',$req->user_id); }
        if ($req->filled('from'))    { $q->where('created_at','>=',$req->from); }
        if ($req->filled('to'))      { $q->where('created_at','<=',$req->to); }
        $logs = $q->orderBy('created_at','desc')->paginate(15);
        return view('logs.index',compact('logs'));
    }

    public function destroy()
    {
        ActivityLog::where('created_at','<',now()->subDays(30))->delete();
        return redirect()->back()->with('success','Log lama berhasil dihapus.');
    }
}
