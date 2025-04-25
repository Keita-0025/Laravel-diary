<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CommentController extends Controller
{
    use AuthorizesRequests;
    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = new Comment($validated);

        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());
        
        $comment->save();

        return redirect()->route('post.show', $post)->with('message', 'コメントを投稿しました！');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);
        $comment->update($validated);
        $request->session()->flash('message', 'コメントを更新しました');
        return redirect()->route('post.show', $comment->post_id);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('post.show', $comment->post_id)->with('message', 'コメントを削除しました');
    }
}
