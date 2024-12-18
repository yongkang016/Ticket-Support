<?php

namespace App\Constants;

class Role
{
    const string SUPER_ADMIN = 'super.admin';
    const string ADMIN = 'admin';
    const string USER = 'user';
    const string STAFF = 'staff';


    public static function generalRole(): array
    {
        return [
            self::SUPER_ADMIN,
            self::ADMIN,
            self::USER,
            self::STAFF,
        ];
    }

    public static function getLabel($value): string
    {
        return match ($value) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::USER => 'User',
            self::STAFF => 'Staff',
            default => $value,
        };
    }

    public static function getLabelWithValue($value): string
    {
        return match ($value) {
            1 => 'Super Admin',
            2 => 'Admin',
            3 => 'User',
            4 => 'Staff',
            default => $value,
        };
    }


    public static function selection($allowSuperAdminOptions = false): array
    {
        $options = [
            1,
            2,
            3,
            4
        ];

        return collect($options)->map(function ($item) use ($allowSuperAdminOptions) {
            if (!$allowSuperAdminOptions && $item == 1) {
                return null;
            }

            return [
                $item => self::getLabelWithValue($item)
            ];
        })->collapseWithKeys()->filter()->toArray();

    }
}
