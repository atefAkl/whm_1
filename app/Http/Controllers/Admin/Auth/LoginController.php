<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

/**
 * Class LoginController
 * @package App\Http\Controllers\Admin\Auth
 * 
 * Handles admin authentication including login, logout, and session management.
 */
class LoginController extends Controller
{
    /**
     * Show the admin login form.
     * 
     * If admin is already authenticated, redirects to profile page.
     * Otherwise, displays the login form.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin-dashboard-home');
        }
        return view('auth.login');
    }

    /**
     * Handle an admin login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function check(Request $request)
    {
        try {
            Log::info('Login attempt', ['email' => $request->email]);

            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);


            Log::info('Validation passed');

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            Log::info('Attempting login with guard: admin');

            if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
                Log::info('Login successful');
                $request->session()->regenerate();

                return redirect()->intended(route('admin-dashboard-home'));
            }

            Log::info('Login failed - invalid credentials');

            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => __('auth.failed'),
                ]);
        } catch (\Exception $e) {
            Log::error('Login error', ['error' => $e->getMessage()]);
            return back()
                ->withInput($request->only('email', 'remember'))
                ->with('error', 'An error occurred during login. Please try again.');
        }
    }

    /**
     * Log the admin out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-login');
    }
}
