<?php

namespace App\Repositories\Contracts;

use App\Http\Dto\UserOperationDto;
use App\Models\UserOperation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserOperationRepositoryInterface
{
    /**
     * @param UserOperationDto $data
     * 
     * @return UserOperation
     */
    public function create(UserOperationDto $dto): UserOperation;

    /**
     * @param int $userId
     * @param int $limit
     * 
     * @return UserOperation[]
     */
    public function getLastOperations(int $userId, int $limit = 5): Collection;

    /**
     * @param int $userId
     * @param string $search
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function searchByDescription(int $userId, string $search, int $perPage = 15): LengthAwarePaginator;

    /**
     * @param int $userId
     * @param string $direction
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function getSortedByDate(int $userId, string $direction = 'desc', int $perPage = 15): LengthAwarePaginator;
}
