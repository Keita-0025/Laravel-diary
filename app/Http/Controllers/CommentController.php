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

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);
        $comment->update($validated);
        $request->session()->flash('message', 'コメントを更新しました');
        return redirect()->route('post.show', $comment->post_id);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('post.show', $comment->post_id)->with('message', 'コメントを削除しました');
    }
}
