<?php

namespace App\Http\Dto;

use App\Contracts\DtoInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserOperationDto implements DtoInterface
{
    public function __construct(
        public readonly int $userId,
        public readonly float $amount,
        public readonly string $operationType,
        public readonly ?string $description,
    ) {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'operation_type' => $this->operationType,
            'description' => $this->description,
        ];
    }

    /**
     * @param array $data
     * 
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            userId: $data['user_id'] ?? throw new BadRequestHttpException('Undefined user_id'),
            amount: $data['amount'] ?? throw new BadRequestHttpException('Undefined amount'),
            operationType: $data['operation_type'] ?? throw new BadRequestHttpException('Undefined operation_type'),
            description: $data['description'] ?? null,
        );
    }
}
