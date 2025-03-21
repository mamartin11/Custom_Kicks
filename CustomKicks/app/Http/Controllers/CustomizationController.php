<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function select()
    {
        $viewData = [];
        $viewData['customizations'] = Customization::all();

        return view('customization.select')->with('viewData', $viewData);
    }

    public function applyCustomization(Request $request)
    {

        $customization = Customization::findOrFail($request->input('id'));

        return redirect()->route('customizations.select')->with([
            'success' => 'Customization applied successfully!',
            'selected_color' => $customization->getColor(),
            'selected_design' => $customization->getDesign(),
            'selected_pattern' => $customization->getPattern(),
        ]);
    }
}
