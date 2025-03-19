<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();
            $message = $user->role == 1 ? 'Welcome back, Admin!' : 'Login successful! Welcome back.';
            
            // Toastr success message
            session()->flash('success', $message);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'redirect' => route($user->role == 1 ? 'dashboard.index' : 'dashboard.users')
                ]);
            }

            return redirect()->route($user->role == 1 ? 'dashboard.index' : 'dashboard.users')
                             ->with('success', $message);
        }

        // Toastr error message
        session()->flash('error', 'Invalid email or password. Please try again.');

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password. Please try again.'
            ], 401);
        }

        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Toastr logout message
        session()->flash('logout', 'You have been successfully logged out.');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'You have been logged out.',
                'redirect' => route('login')
            ]);
        }

        return redirect()->route('login')->with('logout', 'You have been successfully logged out.');
    }
}
