<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserOperationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    public function __construct(private UserOperationRepositoryInterface $operationRepo){}

    public function index(Request $request)
    {
        $user = Auth::user();

        // Сортировка по дате
        $direction = $request->get('direction','desc');
        $operations = $this->operationRepo->getSortedByDate($user->id, $direction);

        return view('operations.index', compact('operations','direction'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = $request->get('search','');
        $operations = $this->operationRepo->searchByDescription($user->id, $search);

        return view('operations.index', compact('operations','search'));
    }
}
