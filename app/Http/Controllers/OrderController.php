<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrdersRequest;
use App\Http\Requests\ListOrdersRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{


    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function create(CreateOrdersRequest $request): JsonResponse
    {
        return response()->json($this->orderService->create($request->validated()), Response::HTTP_CREATED);
    }

    public function list(ListOrdersRequest $request): JsonResponse
    {
        return response()->json($this->orderService->search($request->validated()), Response::HTTP_OK);
    }

    public function updateStatus(UpdateOrderRequest $request): JsonResponse
    {
        $this->orderService->updateStatus($request->validated());
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
