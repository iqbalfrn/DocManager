<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/documents';
    public function __construct(){ $this->middleware('guest')->except('logout'); }

    protected function authenticated(Request $request, $user)
    {
        ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'login',
            'ip_address' => $request->ip(),
            'created_at' => now(),
        ]);
    }

    public function logout(Request $request)
    {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'logout',
            'ip_address' => $request->ip(),
            'created_at' => now(),
        ]);

        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
