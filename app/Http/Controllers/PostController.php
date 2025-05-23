<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helpers\RedirectHelper;


class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $post = new Post($validated);

        $post->user()->associate(auth()->user());
        $post->save();


        $request->session()->flash('message', '保存しました');
        return RedirectHelper::backWithPage($request, 'post.index', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        $comments = $post->comments()->latest()->get();
        return view('post.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('post.index');
    }

    public function mypage()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        return view('post.mypage', compact('posts'));
    }

    public function backToTimeline(Request $request, Post $post)
    {
        // リダイレクト先のページネーション情報を保持
        return RedirectHelper::backWithPage($request, 'post.index', ['post' => $post]);
    }
}
