<?php

namespace App\Repositories\User;

use App\Http\Dto\UserOperationDto;
use App\Models\UserOperation;
use App\Repositories\Contracts\UserOperationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserOperationRepository implements UserOperationRepositoryInterface
{
    /**
     * @param UserOperationDto $dto
     * 
     * @return UserOperation
     */
    public function create(UserOperationDto $dto): UserOperation
    {
        return UserOperation::create($dto->toArray());
    }

    /**
     * @param int $userId
     * @param int $limit
     * 
     * @return UserOperation[]
     */
    public function getLastOperations(int $userId, int $limit = 5): Collection
    {
        return UserOperation::where('user_id', $userId)->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * @param int $userId
     * @param string $search
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function searchByDescription(int $userId, string $search, int $perPage = 15): LengthAwarePaginator
    {
        return UserOperation::where('user_id', $userId)
            ->where('description', 'ilike', "%$search%")
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * @param int $userId
     * @param string $direction
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function getSortedByDate(int $userId, string $direction = 'desc', int $perPage = 15): LengthAwarePaginator
    {
        return UserOperation::where('user_id', $userId)->orderBy('created_at', $direction)->paginate($perPage);
    }
}
