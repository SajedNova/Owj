<?php

namespace App\Http\Controllers;

use App\Ai\Agents\BlogPostGenerator;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('views');

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->when($post->category_fa, fn ($q) => $q->where('category_fa', $post->category_fa))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
    public function post()
    {
        return view('admin.posts.index');
    }

    /**
     * پرامت ادمین را می‌گیرد و با استفاده از ایجنت هوش مصنوعی، یک پست
     * کامل دوزبانه (عنوان، خلاصه، دسته‌بندی، متن) تولید می‌کند تا در
     * فرم ایجاد/ویرایش پست پر شود.
     */
    public function generateAi(Request $request)
    {
        $validated = $request->validate([
            'prompt' => ['required', 'string', 'min:5', 'max:2000'],
        ]);

        try {
            $response = (new BlogPostGenerator)->prompt($validated['prompt']);
        } catch (\Throwable $e) {
            Log::error('AI blog generation failed: '.$e->getMessage());

            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'title_fa' => $response['title_fa'],
            'excerpt_fa' => $response['excerpt_fa'],
            'category_fa' => $response['category_fa'],
            'content_fa' => $response['content_fa'],
            'title_en' => $response['title_en'],
            'excerpt_en' => $response['excerpt_en'],
            'category_en' => $response['category_en'],
            'content_en' => $response['content_en'],
        ]);
    }
}
