<?php


namespace Services\Vote\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Services\Vote\Constants\VoteStatuses;

class StatusRequest extends FormRequest
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
            'status' => 'required|in:' . VoteStatuses::asString(),
        ];
    }
}
