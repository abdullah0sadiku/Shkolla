<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $posts = Media::with('user:id,profile_photo_path,name')->latest()->get(); 
    
        return view('media', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional photo
        ]);

        $media = new Media([
            'text' => $request->text,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();

            $photo->move(public_path('storage/media_photos'), $filename);

            $media->photo = 'media_photos/' . $filename;
        }

        $media->save();

        return redirect()->back()->with('success', 'Postimi u krijua me sukses!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Media::findOrFail($id);
        return response()->json(['post' => $post]);
    }
    
    public function update(Request $request, $id)
    {
        $post = Media::findOrFail($id);
        $request->validate(['text' => 'required|string|max:255']);
    
        $post->text = $request->text;
        $post->save();
    
        return redirect()->route('media')->with('success', 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Media::find($id);
        $path = $post -> photo;
        
        if(!$post){
            return redirect()->back()->with('error', 'Post not found.');
        }
        
        $post->forceDelete();
        return redirect()->route('media.index')->with('success', 'Post deleted successfully.');
    }
}
