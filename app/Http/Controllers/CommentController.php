<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    public function store(Request $request, Post $post)
{
    $validated = $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $validated['post_id'] = $post->id;
    $validated['user_id'] = auth()->id();

    Comment::create($validated);

    return redirect()->route('post.show', $post)->with('message', 'コメントを投稿しました！');
}

}
