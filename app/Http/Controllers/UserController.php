<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DonationType;
use App\Models\Donation;
use App\Models\ShareIdeas;
use App\Models\FundProject;
use App\Models\SubmitDesign;
use App\Models\CodeContribution;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\File;
use Exception;

class UserController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function showRegisterForm(){
        return view('auth.register');
    }

    public function index(){
        $donationtype = DonationType::all();
        return view('user.index', [
            'donationtype' => $donationtype,
        ]);
    }

    public function trending(){
        return view('user.trending');
    }

    public function community(){
        return view('user.community');
    }

    public function store_fund(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
        ]);

        try{
            FundProject::create([
                'title' => $request->title,
                'email' => $request->email,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            return back()->with('success', 'Your contribution has been added');
        }
        catch(Exception $e){
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please check the form and try again.');
        }
    }

    public function store_ideas(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
        ]);

        try{
            ShareIdeas::create([
                'title' => $request->title,
                'email' => $request->email,
                'description' => $request->description,
            ]);

            return back()->with('success', 'Your contribution has been added');
        }
        catch(Exception $e){
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please check the form and try again.');
        }
    }

    public function store_design(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'file_path' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'description' => 'required|string',
        ]);

        try{
            $design = SubmitDesign::create([
                'title' => $request->title,
                'email' => $request->email,
                'description' => $request->description,
            ]);

            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $name_file = time() . "_" . $file->getClientOriginalName();
    
                $destinationPath = public_path('design');
                
                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                
                $file->move($destinationPath, $name_file);
    
                $design->update(['file_path' => $name_file]);
            }

            return back()->with('success', 'Your contribution has been added');
        }
        catch(Exception $e){
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please check the form and try again.');
        }
    }

    public function store_code(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'file_path' => 'required|file|max:10240', // 10MB max
            'description' => 'required|string',
        ]);

        try{
            $code = CodeContribution::create([
                'title' => $request->title,
                'email' => $request->email,
                'description' => $request->description,
            ]);

            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $name_file = time() . "_" . $file->getClientOriginalName();

                $destinationPath = public_path('code');
                
                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                
                $file->move($destinationPath, $name_file);
    
                $code->update(['file_path' => $name_file]);
            }

            return back()->with('success', 'Your contribution has been added');
        }
        catch(Exception $e){
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please check the form and try again.');
        }
    }

    public function donate(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string|max:1000',
        ]);

        try{
            $donation = Donation::create([
                'donation_types_id' => $id,
                'name' => $request->name,
                'email' => $request->email,
                'amount' => $request->amount,
                'message' => $request->message,
                'status' => 'pending',
            ]);

            // Get PayPal configuration
            $paypalEmail = config('paypal.business_email');
            $paypalMeUsername = config('paypal.paypal_me.username');
            
            // Generate PayPal payment URL
            $paypalPaymentUrl = "https://www.paypal.com/paypalme/{$paypalMeUsername}/{$donation->amount}USD";
            
            // Generate QR code URL
            $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($paypalPaymentUrl);

            return redirect()->back()->with([
                'confirmDonationId' => $donation->id,
                'paypalQRUrl' => $qrCodeUrl,
                'donationAmount' => $donation->amount,
                'donationName' => $donation->name,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function confirmdonate($id)
    {
        $donation = Donation::findOrFail($id);
        
        return redirect()->back()->with('success', 'Thank you! We will check your donation is done or not.');
    }
}