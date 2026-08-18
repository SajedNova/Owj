<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['slug'] = Post::generateUniqueSlug($request->input('title'));

        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('success', 'پست جدید با موفقیت ایجاد شد.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('success', 'پست با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'پست با موفقیت حذف شد.');
    }

    public function toggleStatus(Post $post)
    {
        $post->update([
            'status' => $post->status === Post::STATUS_PUBLISHED
                ? Post::STATUS_DRAFT
                : Post::STATUS_PUBLISHED,
            'published_at' => $post->status === Post::STATUS_PUBLISHED
                ? $post->published_at
                : now(),
        ]);

        return back()->with('success', 'وضعیت پست تغییر کرد.');
    }
}
