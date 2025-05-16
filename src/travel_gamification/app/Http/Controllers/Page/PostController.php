<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        // ... các dữ liệu khác ...
        return view('user.layout.community', compact('destinations'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'id_location' => 'required|integer|exists:destinations,id',
            'cost'        => 'nullable|string|max:255',
        ]);

        // Lấy destination
        $destination = Destination::find($validatedData['id_location']);

        $post = new Post();
        $post->title          = $validatedData['title'];
        $post->content        = $validatedData['content'];
        $post->status         = 0;
        $post->user_id        = Auth::id();
        $post->destination_id = $destination->id;
        $post->address        = $destination->address; // Gán địa chỉ tại đây
        $post->price          = $validatedData['cost'] ?? null;

        $post->save();

        return redirect()->route('page.community')->with('success', 'Đăng bài thành công!');
    }

}
