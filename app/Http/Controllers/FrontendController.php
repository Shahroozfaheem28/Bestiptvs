<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Plan;
use App\Models\Category;
use App\Models\Review;
use App\Models\Blog;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
            // Plans jinki expiry date future mein hai (null na ho)
        $plans = Plan::whereIn('validity_days', [30, 90, 180, 365])
            ->orderBy('created_at', 'asc')
            ->withAvg('reviews', 'rating')
            ->get(3);

        // Offer plan jisme discount hai aur expiry date valid hai
        $offerPlan = Plan::whereNotNull('expiry_date')
            ->where('expiry_date', '>=', Carbon::now())
            ->whereColumn('sale_price', '<', 'price')
            ->orderBy('expiry_date', 'asc')
            ->first();

        // Monthly plan with expiry_date
        $freePlan = Plan::where('validity_days', 1)
            ->orderByRaw('IFNULL(sale_price, price) ASC')
            ->withAvg('reviews', 'rating')
            ->first();
        $monthlyPlan = Plan::where('validity_days', 180)
            ->orderByRaw('IFNULL(sale_price, price) ASC')
            ->withAvg('reviews', 'rating')
            ->first();

        // Recent 3 blog posts
        $blogs = Blog::latest()->take(3)->get();
        return view('index', compact('plans', 'offerPlan', 'monthlyPlan', 'blogs', 'freePlan'));
    }

    public function plans()
    {
       $plans = Plan::withAvg('reviews', 'rating')->orderBy('created_at', 'asc')->get();
        $monthlyPlan = Plan::where('slug', '1-month-iptv-subscription-24000-channels-in-full-hd')->first();
        return view('plans', compact('plans', 'monthlyPlan'));
    }

    public function contact()
    {
        return view('Contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::to('shahroozfaheem4@gmail.com')->send(new ContactFormMail($details));

        return redirect()->route('contact')->with('success', 'Thanks for contacting us!'); // ye hona chahiye

    }
    public function faq()
    {
        return view('faq');
    }

    public function plan()
    {
        $plans = Plan::withAvg('reviews', 'rating')->orderBy('created_at', 'asc')->get();

        $categories = Category::all();
        return view('show', compact('plans', 'categories'));
    }

     public function About()
    {
        return view('about');
    }


}
