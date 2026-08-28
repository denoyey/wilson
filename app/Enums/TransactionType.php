<?php

namespace App\Enums;

enum TransactionType: string
{
    case Inbound = 'inbound';
    case Outbound = 'outbound';

    public function label(): string
    {
        return match ($this) {
            self::Inbound => 'Barang Masuk',
            self::Outbound => 'Barang Keluar',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Inbound => 'green',
            self::Outbound => 'red',
        };
    }
}
