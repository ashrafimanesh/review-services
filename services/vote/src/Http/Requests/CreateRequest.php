<?php


namespace Services\Vote\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Services\Review\Facades\Review;
use Services\Vote\Classes\VoteRepository;
use Symfony\Component\HttpFoundation\Response;

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
            : Review::canCreateVote($productKey, $userKey);
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
            'vote' => 'required|gte:0',
        ];
    }

    protected function passedValidation()
    {
        /** @var VoteRepository $repository */
        $repository = app(VoteRepository::class);
        if ($repository->exists($this->get('product_id'), $this->get('user_id'))) {
            $content = json_encode([
                'message' => 'Duplicate vote'
            ]);
            throw new ValidationException($this->validator, new Response($content, 422, ['Content-type' => 'application/json']));
        }
    }
}
