<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('author')
            ->latest()
            ->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'پست جدید با موفقیت ثبت شد.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('success', 'پست حذف شد.');
    }

    public function toggleStatus(Post $post)
    {
        $post->status = $post->status === Post::STATUS_PUBLISHED
            ? Post::STATUS_DRAFT
            : Post::STATUS_PUBLISHED;

        if ($post->status === Post::STATUS_PUBLISHED && empty($post->published_at)) {
            $post->published_at = now();
        }

        $post->save();

        return back()->with('success', 'وضعیت انتشار به‌روزرسانی شد.');
    }

    /**
     * آپلود تصویر داخل متن پست (توسط ادیتور Quill فراخوانی می‌شود)
     * و آدرس عمومی تصویر را برای درج در متن برمی‌گرداند.
     */
    public function uploadContentImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $path = $request->file('image')->store('posts/content', 'public');

        return response()->json([
            'location' => Storage::disk('public')->url($path),
        ]);
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'title_fa'    => 'required|string|max:255',
            'title_en'    => 'nullable|string|max:255',
            'category_fa' => 'nullable|string|max:255',
            'category_en' => 'nullable|string|max:255',
            'excerpt_fa'  => 'nullable|string|max:1000',
            'excerpt_en'  => 'nullable|string|max:1000',
            'content_fa'  => 'required|string',
            'content_en'  => 'nullable|string',
            'status'      => 'required|in:draft,published',
            'image'       => 'nullable|image|max:4096',
        ]);
    }
}
