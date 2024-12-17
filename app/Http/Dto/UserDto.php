<?php

namespace App\Http\Dto;

use App\Contracts\DtoInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserDto implements DtoInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password,
    ) {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
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
            name: $data['name'] ?? throw new BadRequestHttpException('Undefined user_id'),
            email: $data['email'] ?? throw new BadRequestHttpException('Undefined amount'),
            password: $data['password'] ?? null,
        );
    }
}
