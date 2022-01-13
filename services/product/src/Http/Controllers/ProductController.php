<?php


namespace Services\Product\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Services\Product\Classes\ProductRepository;
use Services\Product\Classes\ProductTransformer;
use Services\Product\Http\Requests\ListRequest;
use Services\Product\Http\Requests\VisibilityRequest;

class ProductController extends BaseController
{

    public function indexAction(ListRequest $request, ProductRepository $repository, ProductTransformer $transformer)
    {
        return $this->successResponse($transformer->transform($repository->getProducts($request->getVisibility())));
    }

    public function visibilityAction(VisibilityRequest $request, ProductRepository $repository)
    {
        $repository->changeVisibility($request->get('id'), $request->get('visibility'));
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
