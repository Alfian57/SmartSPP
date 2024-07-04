<?php

namespace App\Helpers;

class Month
{
    public static function translateToID(string $month): string
    {
        $monthNames = [
            'january' => 'januari',
            'february' => 'februari',
            'march' => 'maret',
            'april' => 'april',
            'may' => 'mei',
            'june' => 'juni',
            'july' => 'juli',
            'august' => 'agustus',
            'september' => 'september',
            'october' => 'oktober',
            'november' => 'november',
            'december' => 'desember',
        ];

        return isset($monthNames[$month]) ? $monthNames[$month] : $month;
    }

    public static function all(): array
    {
        return [
            'januari' => 'january',
            'februari' => 'february',
            'maret' => 'march',
            'april' => 'april',
            'mei' => 'may',
            'juni' => 'june',
            'juli' => 'july',
            'agustus' => 'august',
            'september' => 'september',
            'oktober' => 'october',
            'november' => 'november',
            'desember' => 'december',
        ];
    }
}
