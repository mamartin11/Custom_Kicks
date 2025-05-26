<?php

// Nicolas Hurtado A

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminCustomizationController extends Controller
{
    /**
     * Display all customizations for admin dashboard
     */
    public function index(): View
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        $viewData = [];
        $viewData['customizations'] = Customization::all();

        return view('admin.customizations.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for editing a customization
     */
    public function edit(string $id): View
    {
        if (Auth::user()->getRole() !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        $customization = Customization::findOrFail($id);

        $viewData = [];
        $viewData['customization'] = $customization;

        return view('admin.customizations.edit')->with('viewData', $viewData);
    }

    /**
     * Update a customization in storage
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        $customization = Customization::findOrFail($id);

        $customization->setColor($request->input('color'));
        $customization->setDesign($request->input('design'));
        $customization->setPattern($request->input('pattern'));

        $customization->save();

        return redirect()->route('admin.customizations.dashboard')->with('success', 'Customization updated successfully.');
    }

    /**
     * Delete a customization from storage
     */
    public function delete(string $id): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        Customization::destroy($id);

        return redirect()->route('admin.customizations.dashboard')->with('success', 'Customization deleted successfully.');
    }

    /**
     * Show the form for adding a new customization
     */
    public function add(): View
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        return view('admin.customizations.add');
    }

    /**
     * Store a new customization in storage
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        Customization::validations($request);

        $customization = new Customization;
        $customization->setColor($request->input('color'));
        $customization->setDesign($request->input('design'));
        $customization->setPattern($request->input('pattern'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('customizations', 'public');
            $customization->setImage($path);
        }

        $customization->save();

        return redirect()->route('admin.customizations.dashboard')->with('success', 'Customization added successfully.');
    }
}
