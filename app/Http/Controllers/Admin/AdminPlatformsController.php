<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Platforms;

class AdminPlatformsController extends Controller
{
    /**
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getPlatforms()
    {
        $platforms = Platforms::all();

        return view('admin.admin_platforms', compact('platforms'));
    }

    public function addPlatform(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'logo' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);

        $platform = new Platforms;
        $platform->platforms_name = $request->name;
        $platform->logo = $request->logo;
        $platform->slug = $request->slug;
        $platform->save();

        if($platform == true){
            return redirect()->back()->with('success', 'La plateforme a bien été ajoutée.');

        } else {
            return redirect()->back()->with('error', 'Attention ! La plateforme n\'a pas été ajoutée.');
        }
    }

    public function updatePlatform(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'logo' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);

        $id = $request->id;

        $platform = Platforms::find($id);
        $platform->platforms_name = $request->name;
        $platform->logo = $request->logo;
        $platform->slug = $request->slug;
        $platform->save();

        return redirect()->back();
    }

    public function deletePlatform(Request $request)
    {
        $id = $request->id;

        $platform = Platforms::where('id', $id);
        $platform->delete();

        return redirect()->back();
    }
}