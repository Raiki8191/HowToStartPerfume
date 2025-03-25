<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
        //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Post $post, PostRequest $request)
    {
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        dd($image_url);  //画像のURLを画面に表示

        $input = $request['post'];

        // 認証済みユーザーのIDを追加
        $input['user_id'] = \Auth::id();

        $post = new Post();
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request->validated()['post']; // `post` の中身だけを取得
        $post->fill($input_post)->save();

        return redirect()->route('posts.show', ['post' => $post->id])
            ->with('success', '投稿を更新しました！');
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

    //以下のtoppageの関数はtoppageに移動するためのもの
    public function toppage()
    {
        return view('toppage');
    }
}
