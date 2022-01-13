<?php


namespace Services\Comment\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Services\Comment\Classes\CommentRepository;
use Services\Comment\Classes\CommentTransformer;
use Services\Comment\Http\Requests\StatusRequest;
use Services\Comment\Http\Requests\LastCommentsRequest;
use Services\Comment\Http\Requests\ListRequest;
use Services\Comment\Http\Requests\CreateRequest;

class CommentController extends BaseController
{
    /**
     * Show the product comments to manager
     * @param ListRequest $request
     * @param CommentRepository $repository
     * @param CommentTransformer $transformer
     * @return JsonResponse
     */
    public function indexAction(ListRequest $request, CommentRepository $repository, CommentTransformer $transformer)
    {
        $limit = $request->getLimit();
        $offset = $request->getOffset();
        $items = $transformer->transform($repository->getItems($request));
        $total = $repository->getTotalCount($request);
        return $this->successResponse(compact('total', 'limit', 'offset', 'items'));
    }

    /**
     * Show last product comments to user
     * @param LastCommentsRequest $request
     * @param CommentRepository $repository
     * @param CommentTransformer $transformer
     * @return JsonResponse
     */
    public function lastCommentsAction(LastCommentsRequest $request, CommentRepository $repository, CommentTransformer $transformer)
    {
        return $this->successResponse($transformer->transform($repository->getLastComments($request)));
    }

    /**
     * Insert a comment
     * @param CreateRequest $request
     * @param CommentRepository $repository
     * @param CommentTransformer $transformer
     * @return JsonResponse
     */
    public function createAction(CreateRequest $request, CommentRepository $repository, CommentTransformer $transformer)
    {
        return $this->successResponse($transformer->transform(
            $repository->insert($request->product_id, $request->user_id, $request->message)
        ));
    }

    public function statusAction(StatusRequest $request, CommentRepository $repository, CommentTransformer $transformer)
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
