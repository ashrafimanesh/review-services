<?php


namespace Services\Vote\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Services\Vote\Constants\VoteStatuses;
use Services\Vote\Contracts\FilterItemsInterface;

class ListRequest extends FormRequest implements FilterItemsInterface
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
            'product_id' => 'required|string|max:128',
            'status' => 'nullable|in:' . VoteStatuses::asString(),
            'limit' => 'nullable|lte:100',
            'offset' => 'nullable|gte:0'
        ];
    }

    public function getProductKey()
    {
       return $this->get('product_id');
    }

    public function getStatus()
    {
        return $this->get('status');
    }

    public function getLimit(): int
    {
        return $this->get('limit', 20);
    }


    public function getOffset(): int
    {
        return $this->get('offset',0);
    }
}
