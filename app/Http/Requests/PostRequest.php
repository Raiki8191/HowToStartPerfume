<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post.title' => 'required|string|max:255',
            'post.content' => 'required|string|min:10',
            'post.brand' => 'required|string|max:255',
            'post.perfume_name' => 'required|string|max:255',
            'post.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    // public function messages(): array
    // {
    //     return [
    //         'title.required' => 'タイトルは必須です。',
    //         'title.max' => 'タイトルは255文字以内で入力してください。',
    //         'content.required' => '内容は必須です。',
    //         'content.min' => '内容は10文字以上入力してください。',
    //         'brand.required' => 'ブランド名は必須です。',
    //         'brand.max' => 'ブランド名は255文字以内で入力してください。',
    //         'perfume_name.required' => '香水名は必須です。',
    //         'perfume_name.max' => '香水名は255文字以内で入力してください。',
    //         'image.image' => '画像ファイルを選択してください。',
    //         'image.mimes' => '画像の形式はjpeg, png, jpg, gifのみ許可されています。',
    //         'image.max' => '画像サイズは2MB以下にしてください。',
    //     ];
    // }
}
