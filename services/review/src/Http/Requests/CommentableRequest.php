<?php

namespace Services\Review\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Services\Product\Facades\Product;
use Services\Review\Constants\CommentableStatuses;
use Symfony\Component\HttpFoundation\Response;

class CommentableRequest extends FormRequest
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
            'product_id' => 'required',
            'commentable' => 'required|in:' . CommentableStatuses::asString(),
        ];
    }

    protected function passedValidation()
    {
        if(!Product::exists($this->get('product_id'))) {
            $content = json_encode(['message' => 'product does not exists!']);
            throw new ValidationException($this->validator, new Response($content, 422, ['Content-type' => 'application/json']));
        }
    }
}
