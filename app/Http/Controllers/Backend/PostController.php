<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PostDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Content;
use App\Models\Operator;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends BackendController
{
    public $use_form_ajax  = true;
    public $index_view     = "backend.posts.index";

    public function __construct(PostDataTable $dataTable, Post $post)
    {
        parent::__construct($dataTable, $post);
    }

    public function store(PostRequest $request, PostService $PostService)
    {
        $row = $PostService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        $redirect = routeHelper("contents.posts.index", $request->content_id);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.post')]), $redirect);
    }

    public function update(PostRequest $request, PostService $PostService, $id)
    {
        $row = $PostService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.post')]));
    }

    public function append(): array
    {
        return [
            'contents'  => Content::when(request()->content, function($query) {
                $query->where('id', request()->content);
            })->pluck('title', 'id'),
            'operators' => Operator::when(request()->operator, function($query) {
                $query->where('id', request()->operator);
            })->with('country')->get()
        ];
    }

    public function activeToggle()
    {
        $post = Post::find(request()->post_id);
        if (! $post) return response()->json(['failed' => true, 'message' => trans('flash.something is wrong')], 404);
        $post->update(['active' => !$post->active]);
        return response()->json(['success' => true, 'message' => trans('flash.row Updated', ['model' => trans('menu.menu')])], 200);
    }

    public function shortUrlForm($id)
    {
        $post = Post::find($id);
        if (! $post) return $this->throwException('Post not found!');
        return view('backend.posts.short-url', compact('post'));
    }

    public function shortUrl(Request $request)
    {
        try {
            $longUrl = $request->input('URL');
            $exDate = Carbon::now()->addDays(300)->format('Y-m-d');
            $url = $request->type == 'out' ? 'https://short.digizone.com.kw' : 'https://short.ivas.com.eg';
            $url .= "/API/C?URL=$longUrl&ExDate=$exDate&ExURL=$longUrl";

            $ch = curl_init();
            $timeout = 500;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_POSTREDIR, 3);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
