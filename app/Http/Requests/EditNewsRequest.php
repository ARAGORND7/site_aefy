<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditNewsRequest extends Request
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
     *        $news = News::findOrFail($this->route('news'));
    return $news->user_id == 1;
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'content' => 'required:min:10',
            'picture' => 'image'
        ];
    }
}
