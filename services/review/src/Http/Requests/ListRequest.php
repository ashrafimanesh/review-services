<?php

namespace Services\Review\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Services\Review\Constants\CommentableStatuses;

class ListRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|string',
        ];
    }
}
