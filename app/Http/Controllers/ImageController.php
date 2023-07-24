<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // public function store(Request $request)
    // {
    
    //     $image = new Image();
    //     $image->name = $request->file('image')->getClientOriginalName();
    //     $image->image = $request->file('image')->store('image_folder','public');
    
    
    //     // return redirect()->back();
    //     $image->save();

    //     return redirect()->back()->with('message', 'Image uploaded successfully');
    // }
    public function store(Request $request)
{
    // echo "<pre>";
    // print_r($request->toArray());
    // die;
    $request->validate([
        'name' => 'required',
        'price' => 'required',
        'image' => 'required|image|max:5000',

    ]);

    $path = $request->file('image');
    $imageName = time() . '.' . $path->extension();

    $path->storeAs('public/images', $imageName);
    Image::create([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'path' => 'storage/images/' . $imageName,

    ]);

    return redirect()->back()->with('success', 'Image uploaded successfully.');
}

}
