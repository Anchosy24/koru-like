<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\OtpMail;
use App\Models\User;
use App\Models\Verification;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($request->only('email', 'password'))){
            $request->session()->regenerate();
            
            if(Auth::user()->role == 'admin') {
                return redirect('/dashboard')->with('success', 'Admin has logged in');
            }
            return redirect('/home')->with('success', 'You have been successfully logged in');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            're-password' => 'required|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'verify',
            'role' => 'user',
        ]);

        $otp = rand(100000, 999999);
        $verify = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5($otp),
            'type' => $request->type ?? 'register',
            'status' => 'active',
        ]);
        
        Mail::to($user->email)->queue(new OtpMail($otp));
        
        if($request->type == 'register' || !$request->type){
            return redirect('/verify/'.$verify->unique_id);
        }
    }

    public function showverifyform($unique_id){
        $verify = Verification::where('unique_id', $unique_id)
            ->where('status', 'active')
            ->first();
            
        if(!$verify) {
            abort(404);
        }
        
        $user = User::findOrFail($verify->user_id);
        
        return view('auth.verify', [
            'user' => $user,
            'unique_id' => $unique_id,
        ]);
    }

    public function updateStatus(Request $request, $unique_id){
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric|digits:1',
        ]);

        $verify = Verification::where('unique_id', $unique_id)
            ->where('status', 'active')
            ->first();
            
        if(!$verify) {
            abort(404);
        }
        
        $code = implode('', $request->input('otp', []));
        
        if(md5($code) != $verify->otp){
            $verify->update(['status' => 'invalid']);
            return redirect('/verify/'.$unique_id)->with('error', 'Invalid OTP code. Please try again.');
        }
        
        $verify->update(['status' => 'valid']);
        
        $user = User::findOrFail($verify->user_id);
        $user->update(['status' => 'active']);
        
        Auth::login($user);
        $request->session()->regenerate();
        
        return redirect('/home')->with('success', 'You have been successfully registered');
    }

    public function google_redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function google_callback(){
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'status' => 'active',
                    'role' => 'user',
                    'password' => Hash::make(uniqid()),
                ]);
            }
            
            Auth::login($user);
            request()->session()->regenerate();
            
            if($user->role == 'user') {
                return redirect('/home')->with('success', 'You have been successfully logged in');
            }
            
            return redirect('/dashboard')->with('success', 'Admin has logged in');
            
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Unable to login with Google. Please try again.');
        }
    }
    
    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been successfully logged out');
    }
}