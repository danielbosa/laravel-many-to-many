<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Technology;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all(); 
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $form_data = $request->all();
        if($request->hasFile('image')){
            $name = $request->image ->getClientOriginalName();
            $path = Storage::putFileAs('tech_images', $request->image, $name);
            $form_data['image'] = $path;
        };
        $form_data['slug'] = Technology::generateSlug($form_data['name']);
        $newTechnology = Technology::create($form_data);
        return redirect()->route('admin.technologies.show', $newTechnology->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $form_data = $request->all();
        //$form_data['user_id'] = Auth::id();
        //se il titolo è diverso, allora aggiorno anche lo slug
        if ($technology->name !== $form_data['name']) {
            $form_data['slug'] = Technology::generateSlug($form_data['name']);
        }
        if ($request->hasFile('image')) {
            if ($technology->icon) {
                Storage::delete($technology->icon);
            }
            $name = $request->image->getClientOriginalName();
            //dd($name);
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $form_data['icon'] = $path;
        }
        // DB::enableQueryLog();
        $technology->update($form_data);
        // $query = DB::getQueryLog();
        // dd($query);
        return redirect()->route('admin.technologies.show', $technology->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message', $technology->name . ' è stato eliminato');
    }
}
