<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        $user = request()->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')],
            'email' => ['required', 'max:255', 'min:3', Rule::unique('users', 'email')],
            'password' => ['required', 'max:255', 'min:8'],
        ]);

        $currentUser = User::create($user);

        $otp = rand(100000, 999999);

        Authentication::create([
            'user_id' => $currentUser->id,
            'otp' => $otp,
        ]);

        $this->mailOtp($otp, $currentUser->name, $currentUser->email);
        return view('users.authenticate', ['id' => $currentUser->id, 'otp' => $otp]);
    }

    public function checkAndRedirect(Request $request){
        $user = $request->validate([
            'id' => ['required'],
            'otp' => ['required', 'max:6', 'min:6'],
        ]);

        $authUser = Authentication::where('user_id', $user['id'])->get();
        $currentUser = User::where('id', $user['id'])->get();

        if(count($authUser) > 0 && count($currentUser) > 0) {
            if($user['otp'] == $authUser[0]->otp){
                User::where('id', $user['id'])->update(['is_authorized' => true]);
                Authentication::where('user_id', $user['id'])->delete();
                $currentUser = User::where('id', $user['id'])->get();
                auth()->login($currentUser[0]);
                return redirect('/')->with('success', 'Welcome aboard!');
            }else{
                return redirect('/')->with('error', 'Invalid OTP!');
            }
        }else{
            return redirect('/')->with('error', 'Invalid OTP!');
        }
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    protected function mailOtp($otp, $name, $email){
        $arrayEmails = [$email];
        $emailSubject = 'Otp for Travel Blog';
        $emailBody = 'Hello '.$name.', your otp is '.$otp.'. Please do not share this with anyone. Thank you.';

        Mail::send('emails.normal',
            ['msg' => $emailBody],
            function($message) use ($arrayEmails, $emailSubject) {
                $message->to($arrayEmails)
                    ->subject($emailSubject);
            }
        );
    }
}
