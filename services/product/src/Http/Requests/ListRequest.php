<?php

namespace Services\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Services\Product\Constants\VisibilityValues;

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
            'visibility' => 'nullable|in:' . VisibilityValues::asString()
        ];
    }

    public function getVisibility()
    {
        return $this->isManager() ? $this->get('visibility') : VisibilityValues::VISIBLE;
    }

    protected function isManager()
    {
        //@todo: Check with auth
        return $this->get('role') == 'manager';
    }

}
