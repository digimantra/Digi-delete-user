<?php

namespace appdigidelete\AccountDeletion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use appdigidelete\AccountDeletion\Models\DeletedUser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use appdigidelete\AccountDeletion\Mail\OtpMail;
use appdigidelete\AccountDeletion\Models\Otp;


class AccountController extends Controller
{

    public function requestDeletion(Request $request)
    {
    $request->validate(['email' => 'required|email']);



    // Find the user in the user table
    $userTable = config('accountdeletion.user_table');
    $userExists = DB::table($userTable)->where('email', $request->email)->first();
    \Log::info('Query result: ' . ($userExists ? 'User exists' : 'User does not exist'));

    if ($userExists) {
        // Generate OTP
        
        $otp = rand(100000, 999999);
        Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'created_at' => now(),
                'validated_at' => null,
            ]
        );
        Cache::put('otp_email', $request->email, 300);
    
        Mail::to($request->email)->send(new OtpMail($otp));
    
        return redirect()->route('otp.confirm.form')->with('email', $request->email);
    } else {
        return redirect()->route('otp.request.form')->with('message', 'Account deletion failed Email Doesnt Exists.');
    
        // session()->flash('userError', 'User does not exist in our records.');
    //    return redirect()->route('otp.request.form')
    //         ->with('message','Account deletion failed. Please try again later.');
    }
 
    }




    public function confirmDeletion(Request $request)
    {
    // Get the email from the cache
    $email = Cache::get('otp_email');

    // Validate OTP
    $request->validate([
        'otp' => 'required|digits:6',
    ]);

    // If the email is not found in cache, return an error
    if (!$email) {
        return redirect()->route('otp.request.form')
            ->withErrors(['email' => 'Email is not set. Please request an OTP first.']);
    }

    // Check if the user exists in the database
    $userTable = config('accountdeletion.user_table');
    $userExists = DB::table($userTable)->where('email', $email)->exists();

    if (!$userExists) {
        return redirect()->route('otp.request.form')
            ->withErrors(['email' => 'User does not exist in our records.'])
            ->withInput();
    }

    // Start a database transaction
    DB::beginTransaction();
    try {
        $otpRecord = Otp::where('email', $email)->first();

        // Check if the OTP exists and is valid
        if (!$otpRecord || $otpRecord->otp !== $request->otp || $otpRecord->created_at->addMinutes(10) < now()) {
            return redirect()->route('otp.request.form')
                ->withErrors(['otp' => 'Invalid or expired OTP.'])
                ->withInput();
        }

        // Mark the OTP as validated
        $otpRecord->validated_at = now();
        $otpRecord->save();

        // Fetch the user data
        $user = DB::table($userTable)->where('email', $email)->first();
        $userArray = (array) $user;

        // Store deleted user data
        DeletedUser::create([
            'email' => $user->email,
            'name' => $user->name,
            'deleted_data' => json_encode($userArray),
        ]);

        // Delete the user and the OTP entry
        DB::table($userTable)->where('email', $email)->delete();
        $otpRecord->delete();

        // Commit the transaction
        DB::commit();

        return redirect()->route('otp.request.form')
            ->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
        
        DB::rollBack();

        \Log::error('Account deletion failed: ' . $e->getMessage());

        return redirect()->route('otp.request.form')
            ->withErrors(['error' => 'Account deletion failed. Please try again later.']);
    }
}

    



    public function resendOtp(Request $request)
    {
        // Validate email
        $request->validate(['email' => 'required|email']);

        $otp = rand(100000, 999999);
        Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'created_at' => now(),
                'validated_at' => null,
            ]
        );
        Cache::put('otp_email', $request->email, 300);

        Mail::to($request->email)->send(new OtpMail($otp));
        // Return a JSON response for the AJAX request
        return response()->json(['message' => 'OTP resent to ' . $request->email]);
    }
}
