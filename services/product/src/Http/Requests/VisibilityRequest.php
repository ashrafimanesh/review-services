<?php


namespace Services\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Services\Product\Constants\VisibilityValues;

class VisibilityRequest extends FormRequest
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
            'id' => 'required|string|max:128',
            'visibility' => 'required|in:' . VisibilityValues::asString(),
        ];
    }
}
