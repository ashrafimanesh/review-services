<?php


namespace Services\Review\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Services\Review\Classes\ReviewSettingRepository;
use Services\Review\Classes\ReviewSettingTransformer;
use Services\Review\Http\Requests\CommentableRequest;
use Services\Review\Http\Requests\ListRequest;
use Services\Review\Http\Requests\VoteableRequest;

class SettingController extends BaseController
{
    public function indexAction(ListRequest $request, ReviewSettingRepository $repository, ReviewSettingTransformer $transformer)
    {
        return $this->successResponse($transformer->transform(
            $repository->getByProductsWithDetails($request->get('product_ids'))
        ));
    }

    public function commentableAction(CommentableRequest $request, ReviewSettingRepository $repository)
    {
        $repository->updateCommentable($request->get('product_id'), $request->get('commentable'));
        return $this->successResponse(null);
    }

    public function voteableAction(VoteableRequest $request, ReviewSettingRepository $repository)
    {
        $repository->updateVoteable($request->get('product_id'), $request->get('voteable'));
        return $this->successResponse(null);
    }

    /**
     * @param array|null $data
     * @return JsonResponse
     */
    protected function successResponse(?array $data)
    {
        return response()->json([
            'message' => 'ok',
            'errors' => null,
            'data' => $data,
        ]);
    }

}
