<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            
            // ১. আন্তর্জাতিক সিকিউরিটি: প্রথমে স্ট্যাটাস চেক করা হচ্ছে (শুধুমাত্র status = 2 এলাউড)
            if ((int)$user->status !== 2) {
                throw ValidationException::withMessages([
                    'email' => ['আপনার অ্যাকাউন্টটি অনুমোদিত বা সক্রিয় নয়। অনুগ্রহ করে অ্যাডমিনের সাথে যোগাযোগ করুন।'],
                ]);
            }

            // ২. পাসওয়ার্ড ম্যাচিং লজিক (Bcrypt বনাম MD5)
            $passwordMatches = false;

            if (Hash::needsRehash($user->password) === false) {
                $passwordMatches = Hash::check($request->password, $user->password);
            } else {  
                $passwordMatches = (md5($request->password) === $user->password);
            }

            // ৩. পাসওয়ার্ড সঠিক হলে সেশন জেনারেট এবং রোল অনুযায়ী রিডাইরেক্ট
            if ($passwordMatches) {
                Auth::login($user, $request->boolean('remember'));
                $request->session()->regenerate();

                // ইউজার রোল অনুযায়ী সঠিক ড্যাশবোর্ডে রিডাইরেক্ট করার লজিক
                if ($user->role === 'admin') {
                    return redirect()->intended(route('admin.dashboard'));
                }
                
                return redirect()->intended(route('dashboard'));
            }
        }

        // ৪. লগইন ব্যর্থ হলে স্মার্ট বাংলা এরর মেসেজ দেবে
        throw ValidationException::withMessages([
            'email' => ['প্রদানকৃত তথ্য আমাদের রেকর্ডের সাথে মিলছে না। অনুগ্রহ করে আবার চেষ্টা করুন।'],
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
