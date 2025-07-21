<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\Category;
use App\Models\Review;

use Illuminate\Http\Request;


class PlanController extends Controller
{
   public function index(Request $request)
    {
            $plans = Plan::query();
            $filterName = null;

            if ($request->has('category')) {
                $category = Category::find($request->category);
                if ($category) {
                    $plans->where('category_id', $category->id);
                    $filterName = $category->name;
                }
            }

            if ($request->has('tag')) {
                $plans->where('tags', 'LIKE', '%' . $request->tag . '%');
                $filterName = $request->tag;
            }

            $plans = $plans->latest()->get();
            $categories = Category::all();

            return view('show', compact('plans', 'categories', 'filterName'));
    }

    public function show($slug)
        {
            $plan = Plan::with('category')->where('slug', $slug)->firstOrFail();
            $relatedPlans = Plan::withAvg('reviews', 'rating')
                            ->where('category_id', $plan->category_id)
                            ->where('id', '!=', $plan->id)
                            ->latest()
                            ->take(3)
                            ->get();
            $reviews = Review::where('plan_id', $plan->id)->with('user')->latest()->get();
            $averageRating = Review::where('plan_id', $plan->id)->avg('rating');
            return view('plandetails', compact('plan', 'relatedPlans', 'reviews', 'averageRating'));
        }

}
