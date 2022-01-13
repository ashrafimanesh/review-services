<?php


namespace Services\Comment\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Services\Comment\Constants\CommentStatuses;
use Services\Comment\Contracts\FilterItemsInterface;

class LastCommentsRequest extends FormRequest implements FilterItemsInterface
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
            'product_ids.*' => 'required|string|max:128'
        ];
    }

    public function getProductKey()
    {
       return $this->get('product_ids');
    }

    public function getStatus()
    {
        return CommentStatuses::APPROVED;
    }

    public function getLimit(): int
    {
        return 3;
    }

    public function getOffset(): int
    {
        return 0;
    }
}
