<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;

class AdminCustomizationController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['customizations'] = Customization::all();

        return view('admin.dashboard')->with('viewData', $viewData);
    }

    public function edit($id)
    {
        $customization = Customization::findOrFail($id);

        return view('admin.editCustomization')->with('customization', $customization);
    }

    public function update(Request $request, $id)
    {
        $customization = Customization::findOrFail($id);

        $customization->setColor($request->input('color'));
        $customization->setDesign($request->input('design'));
        $customization->setPattern($request->input('pattern'));
        $customization->setImage($request->input('image'));
        $customization->save();

        return redirect()->route('admin.customizations.dashboard')->with('success', 'Customización actualizada correctamente.');
    }

    public function delete($id)
    {
        Customization::destroy($id);

        return redirect()->route('admin.customizations.dashboard')->with('success', 'Customización eliminada correctamente.');
    }

    public function add()
    {
        return view('admin.addCustomization');
    }

    public function store(Request $request)
    {

        Customization::validations($request);

        $customization = new Customization;
        $customization->setColor($request->input('color'));
        $customization->setDesign($request->input('design'));
        $customization->setPattern($request->input('pattern'));
        $customization->setImage($request->input('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('customizations', 'public');
            $customization->setImage($path);
        }
        
        $customization->save();

        return redirect()->route('admin.customizations.dashboard')->with('success', 'Customización agregada correctamente.');
    }
}
