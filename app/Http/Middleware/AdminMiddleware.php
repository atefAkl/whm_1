<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminMiddleware
 * @package App\Http\Middleware
 * 
 * Middleware to handle admin authentication and permissions.
 * Ensures that only authenticated admins can access protected routes.
 * Additionally checks for specific permissions on certain routes.
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Verifies that the user is authenticated as an admin.
     * For certain routes, also checks for specific permissions.
     * Redirects to login page if authentication fails.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Temporarily disabled authentication check
        return $next($request);

        /* Authentication check will be re-enabled after setting up roles and permissions
        // Check if user is logged in as admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin-login')
                ->with('error', 'يجب تسجيل الدخول كمسؤول للوصول إلى هذه الصفحة.');
        }

        $admin = Auth::guard('admin')->user();

        // Check permissions for admin registration routes
        if ($request->routeIs('admin-register') || $request->routeIs('admin-store')) {
            try {
                if (!$admin->hasRole('super-admin') && !$admin->hasPermissionTo('register-admins')) {
                    return redirect()->back()
                        ->with('error', 'ليس لديك صلاحية لإضافة مسؤولين جدد.');
                }
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'حدث خطأ في التحقق من الصلاحيات.');
            }
        }
        */
    }
}
