<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        // dd($image_url);

        $input = $request['post'];

        // 認証済みユーザーのIDを追加
        $input['user_id'] = \Auth::id();

        if ($request->file('image')) {
            $image_url = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'posts',
                'transformation' => [
                    'width' => 500,
                    'height' => 500,
                    'crop' => 'pad', // 足りない部分に背景を追加
                    'background' => 'auto', // 背景色を自動設定
                    'quality' => 'auto:good'
                ]
            ])->getSecurePath();

            $input += ['image' => $image_url];
        }

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
        // 認可チェック
        $this->authorize('update', $post);

        $input_post = $request->validated()['post'];

        // 画像を削除するかどうかを確認
        if ($request->has('delete_image') && $request->input('delete_image') == 1) {
            $input_post['image'] = null; // 画像を削除
        } elseif ($request->file('image')) {
            // 新しい画像がアップロードされた場合（リサイズ & 圧縮を適用）
            $image_url = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'posts',
                'transformation' => [
                    'width' => 500,
                    'height' => 500,
                    'crop' => 'pad', // 足りない部分に背景を追加
                    'background' => 'auto', // 背景色を自動設定
                    'quality' => 'auto:good'
                ]
            ])->getSecurePath();

            $input_post['image'] = $image_url;
        }

        $post->fill($input_post)->save();

        return redirect()->route('posts.show', ['post' => $post->id])
            ->with('success', '投稿を更新しました！');
    }


    public function delete(Post $post)
    {
        // 認可チェック（ポリシーを使用）
        $this->authorize('delete', $post);

        // 投稿を削除
        $post->delete();

        return redirect('/')->with('success', '投稿を削除しました！');
    }

    //以下のtoppageの関数はtoppageに移動するためのもの
    public function toppage()
    {
        return view('toppage');
    }
}
