<?php


namespace Services\Vote\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Services\Vote\Classes\VoteRepository;
use Services\Vote\Classes\VoteTransformer;
use Services\Vote\Http\Requests\CreateRequest;
use Services\Vote\Http\Requests\ListRequest;
use Services\Vote\Http\Requests\StatusRequest;

class VoteController extends BaseController
{
    /**
     * Show last product vote to manager
     * @param ListRequest $request
     * @param VoteRepository $repository
     * @param VoteTransformer $transformer
     * @return JsonResponse
     */
    public function indexAction(ListRequest $request, VoteRepository $repository, VoteTransformer $transformer)
    {
        $limit = $request->getLimit();
        $offset = $request->getOffset();
        $items = $transformer->transform($repository->getItems($request));
        $total = $repository->getTotalCount($request);
        return $this->successResponse(compact('total', 'limit', 'offset', 'items'));
    }

    /**
     * Insert a vote
     * @param CreateRequest $request
     * @param VoteRepository $repository
     * @param VoteTransformer $transformer
     * @return JsonResponse
     */
    public function createAction(CreateRequest $request, VoteRepository $repository, VoteTransformer $transformer)
    {
        return $this->successResponse($transformer->transform(
            $repository->insert($request->product_id, $request->user_id, $request->vote)
        ));
    }

    public function statusAction(StatusRequest $request, VoteRepository $repository, VoteTransformer $transformer)
    {
        return $this->successResponse($transformer->transform(
            $repository->changeStatus($request->get('id'), $request->get('status'))
        ));
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
