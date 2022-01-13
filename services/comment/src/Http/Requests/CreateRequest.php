<?php


namespace Services\Comment\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Services\Review\Facades\Review;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $productKey = $this->get('product_id');
        $userKey = $this->get('user_id');
        return is_null($productKey) || is_null($userKey)
            ? true
            : Review::canCreateComment($productKey, $userKey);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|string|max:128',
            'user_id' => 'required|string|max:128',
            'message' => 'required|string|max:1280',
        ];
    }
}
