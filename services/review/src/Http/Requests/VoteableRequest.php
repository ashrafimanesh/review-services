<?php

namespace Services\Review\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Services\Product\Constants\VisibilityValues;
use Services\Product\Facades\Product;
use Services\Review\Constants\VoteableStatuses;
use Symfony\Component\HttpFoundation\Response;

class VoteableRequest extends FormRequest
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
            'voteable' => 'required|in:' . VoteableStatuses::asString(),
        ];
    }

    protected function passedValidation()
    {
        if(!Product::exists($this->get('product_id'), VisibilityValues::VISIBLE)) {
            $content = json_encode(['message' => 'product does not exists!']);
            throw new ValidationException($this->validator, new Response($content, 422, ['Content-type' => 'application/json']));
        }
    }
}
