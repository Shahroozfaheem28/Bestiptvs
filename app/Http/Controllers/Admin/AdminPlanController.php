<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Plan;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class AdminPlanController extends Controller
{
    public function dashboard()
    {
        $adminCount = User::where('role', 'admin')->count();
    $userCount = User::where('role', 'user')->count();
    $categoryCount = Category::count();
    $planCount = Plan::count();
    $blogCount = Blog::count();

    return view('admin.index', compact('adminCount', 'userCount', 'categoryCount', 'planCount', 'blogCount'));

    }

    public function index()
    {


        $plans = Plan::all();
        return view('admin.plans.plansview', compact('plans'));
    }

    public function create()
    {


        $categories = Category::all();
        return view('admin.plans.create', compact('categories'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'validity_days' => 'required|integer',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required|numeric',
            'expiry_date' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('plan_images', 'public');
        }

        Plan::create([
            'title' => $request->title,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'validity_days' => $request->validity_days,
            'description' => $request->description,
            'tags' => $request->tags,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'expiry_date'   => $request->expiry_date,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit($id)
    {


        $plan = Plan::findOrFail($id);
        $categories = Category::all();
        return view('admin.plans.edit', compact('plan', 'categories'));
    }

    public function update(Request $request, Plan $plan)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'validity_days' => 'required|integer',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required|numeric',
            'expiry_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($plan->image) {
                Storage::disk('public')->delete($plan->image);
            }
            $plan->image = $request->file('image')->store('plan_images', 'public');
        }

        $plan->update([
            'title' => $request->title,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'validity_days' => $request->validity_days,
            'description' => $request->description,
            'tags' => $request->tags,
            'image' => $plan->image,
            'category_id' => $request->category_id,
            'expiry_date'   => $request->expiry_date,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {


        if ($plan->image) {
            Storage::disk('public')->delete($plan->image);
        }
        $plan->delete();

        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }


}
