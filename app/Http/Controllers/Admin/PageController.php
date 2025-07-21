<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page Created');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page Updated');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('success', 'Page Deleted');
    }
    public function aboutCompany()
    {
        $page = Page::where('slug', 'about-company')->firstOrFail();
        return view('pages.aboutcompany', compact('page'));
    }
    public function showPrivacyPolicy()
    {
        $page = Page::where('slug', 'privacy-policy')->firstOrFail();

        return view('pages.privacy', compact('page'));
    }
    public function refundreturn()
    {
        $page = Page::where('slug', 'refund-returns')->firstOrFail();
        return view('pages.refund', compact('page'));
    }
    public function showTermsConditions()
        {
             
            $page = Page::where('slug', 'terms-conditions')->firstOrFail();
            return view('pages.terms', compact('page'));
        }
}
