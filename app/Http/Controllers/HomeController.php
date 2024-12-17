<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserBalanceRepositoryInterface;
use App\Repositories\Contracts\UserOperationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(
        private UserBalanceRepositoryInterface $balanceRepo,
        private UserOperationRepositoryInterface $operationRepo
    ) {}

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $balance = $this->balanceRepo->getByUserId($user->id)->balance;
        $operations = $this->operationRepo->getLastOperations($user->id, 5);
        return view('home', compact('balance', 'operations'));
    }

    /**
     * @return JsonResponse
     */
    public function ajaxData(): JsonResponse
    {
        $user = Auth::user();
        $balance = $this->balanceRepo->getByUserId($user->id)->balance;
        $operations = $this->operationRepo->getLastOperations($user->id, 5);
        return response()->json([
            'balance' => $balance,
            'operations' => $operations
        ]);
    }
}
