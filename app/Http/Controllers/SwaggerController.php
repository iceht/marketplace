<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\JsonResponse;

class SwaggerController extends Controller
{

    public function index(): string
    {
        return view('swagger');
    }

    public function updateStatus(UpdateOrderRequest $request, int $id): JsonResponse
    {
        return response()->json(null, 202);
    }
}
