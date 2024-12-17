<?php

namespace App\Enums;

enum UserOperationTypeEnum: string {
    case withdrawal = 'withdrawal';
    case deposit = 'deposit';
}