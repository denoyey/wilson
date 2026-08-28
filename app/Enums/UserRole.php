<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case SPV = 'spv';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::SPV => 'SPV (Supervisor)',
        };
    }
}
