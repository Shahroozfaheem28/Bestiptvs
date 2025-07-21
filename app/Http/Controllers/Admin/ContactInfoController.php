<?php

namespace App\Http\Controllers\Admin;
use App\Models\ContactInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
        {
            $contacts = ContactInfo::latest()->get();
            return view('admin.contact.index', compact('contacts'));
        }

    public function create()
        {
            return view('admin.contact.create');
        }

    public function store(Request $request)
        {
            $request->validate([
                'address' => 'required',
                'email' => 'required|email',
                'whatsapp_number' => 'required',
            ]);

            ContactInfo::create($request->all());

            return redirect()->route('admin.contact.index')->with('success', 'Contact info created.');
        }

        public function edit($id)
        {
            $info = ContactInfo::findOrFail($id);
            return view('admin.contact.edit', compact('info'));
        }

    public function update(Request $request, $id)
        {
            $request->validate([
                'address' => 'required',
                'email' => 'required|email',
                'whatsapp_number' => 'required',
            ]);

            $info = ContactInfo::findOrFail($id);
            $info->update($request->all());

            return redirect()->route('admin.contact.index')->with('success', 'Contact info updated.');
        }

    public function destroy($id)
        {
            ContactInfo::findOrFail($id)->delete();
            return redirect()->route('admin.contact.index')->with('success', 'Contact info deleted.');
        }
    public function boot()
        {
            View::composer('layouts.navbar', function ($view) {
                $contact = ContactInfo::first();
                $view->with('contact', $contact);
            });
        }
}
