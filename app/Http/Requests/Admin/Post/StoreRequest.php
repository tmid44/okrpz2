<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required | string',
            'content' => 'required | string',
            'main_image' => 'required | file',
            'additional_image' => 'nullable | file',
            'category_id' => 'required |integer| exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable |integer| exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Це поле потрібно заповнити',
            'title.string'=>'Це поле повенне бути текстове',
            'content.required'=>'Це поле потрібно заповнити',
            'content.string'=>'Це поле повенне бути текстове',
            'main_image.required'=>'Це поле потрібно заповнити',
            'main_image.file'=>'Необхідно обрати файл',
            'additional_image.file'=>'Необхідно обрати файл',
            'category_id.required'=>'Це поле потрібно заповнити',
            'category_id.integer'=>'Id повине бути числовим',
            'category_id.exists'=>'Id повене бути в базі даних',
            'tag_ids.array'=>'Необхідно відправити масив даних',
        ];
    }
}
