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
use App\Mail\ConfirmMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdminController extends Controller
{
    public function index(){
        $today = date('Y-m-d');
    
        $fund = FundProject::whereDate('created_at', $today)->count();
        $design = SubmitDesign::whereDate('created_at', $today)->count();
        $code = CodeContribution::whereDate('created_at', $today)->count();
        $idea = ShareIdeas::whereDate('created_at', $today)->count();

        $contributiontoday = $fund + $design + $code + $idea;

        $donationToday = Donation::whereDate('created_at', $today)
            ->where('status', 'done')
            ->sum('amount');

        /* ---------- 7-day contribution statistics ---------- */
        $startDate = Carbon::now()->subDays(6)->startOfDay();   // 6 days ago + today = 7 days
        $endDate   = Carbon::now()->endOfDay();

        /* helper that returns a zero-filled array [date => 0] for the last 7 days */
        $dateRange = [];
        for ($i = 6; $i >= 0; $i--) {
            $dateRange[Carbon::now()->subDays($i)->format('Y-m-d')] = 0;
        }

        /* count rows per day for each table */
        $fundByDay   = FundProject::whereBetween('created_at', [$startDate, $endDate])
                        ->select(DB::raw('DATE(created_at) as date, count(*) as aggregate'))
                        ->groupBy('date')
                        ->pluck('aggregate', 'date');

        $designByDay = SubmitDesign::whereBetween('created_at', [$startDate, $endDate])
                        ->select(DB::raw('DATE(created_at) as date, count(*) as aggregate'))
                        ->groupBy('date')
                        ->pluck('aggregate', 'date');

        $codeByDay   = CodeContribution::whereBetween('created_at', [$startDate, $endDate])
                        ->select(DB::raw('DATE(created_at) as date, count(*) as aggregate'))
                        ->groupBy('date')
                        ->pluck('aggregate', 'date');

        $ideaByDay   = ShareIdeas::whereBetween('created_at', [$startDate, $endDate])
                        ->select(DB::raw('DATE(created_at) as date, count(*) as aggregate'))
                        ->groupBy('date')
                        ->pluck('aggregate', 'date');

        /* merge real counts into the zero-filled range */
        $labels = [];
        $fund   = [];
        $design = [];
        $code   = [];
        $idea   = [];

        foreach ($dateRange as $day => $zero) {
            $labels[] = Carbon::parse($day)->format('m/d'); // US style: 10/06
            $fund[]   = $fundByDay->get($day,   0);
            $design[] = $designByDay->get($day, 0);
            $code[]   = $codeByDay->get($day,   0);
            $idea[]   = $ideaByDay->get($day,   0);
        }

        /* build Chart.js dataset format */
        $datasets = [
            [
                'label' => 'Fund Projects',
                'data'  => $fund,
                'backgroundColor' => '#4CAF50',
            ],
            [
                'label' => 'Design Submissions',
                'data'  => $design,
                'backgroundColor' => '#2196F3',
            ],
            [
                'label' => 'Code Contributions',
                'data'  => $code,
                'backgroundColor' => '#FF9800',
            ],
            [
                'label' => 'Shared Ideas',
                'data'  => $idea,
                'backgroundColor' => '#9C27B0',
            ],
        ];

        /* pass everything to the view */
        return view('admin.index', [
            'contributiontoday' => $contributiontoday,
            'donationToday'     => $donationToday,
            'labels'            => $labels,
            'datasets'          => $datasets,
        ]);
    }

    public function donationpage(){
        $donation = Donation::with('type')->orderBy('created_at')->get();
        return view('admin.donation', compact('donation'));
    }

    public function userpage(){
        $user = User::where('role', 'user')->get();
        return view('admin.user', compact('user'));
    }

    public function contributionpage(){
        $fund = FundProject::orderBy('created_at')->get();
        $design = SubmitDesign::orderBy('created_at')->get();
        $code = CodeContribution::orderBy('created_at')->get();
        $idea = ShareIdeas::orderBy('created_at')->get();
        return view('admin.contribution', [
            'fund' => $fund,
            'design' => $design,
            'code' => $code,
            'idea' => $idea,
        ]);
    }

    public function confirmPayment($id)
    {
        $donation = Donation::findOrFail($id);
        $donationType = DonationType::findOrFail($donation->donation_types_id);

        // Update donation status
        $donation->update(['status' => 'done']);

        // Add to donation type total
        $donationType->amount += $donation->amount;
        $donationType->save();
        Mail::to($donation->email)->queue(new ConfirmMail($donation));

        return redirect()->back()->with('success', 'You have been updated the donation status!');
    }
}