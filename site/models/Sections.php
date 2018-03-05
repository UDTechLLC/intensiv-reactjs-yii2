<?php
namespace app\models;

class Sections
{
    const INTENSIV_PAKET = 1;
    const OVNINGS_PAKET = 2;
    const OVRIGA_TJANSTER = 3;
    const KURSES = 4;

    public static function getList()
    {
        return [
            self::INTENSIV_PAKET => 'Intensivpaket',
            self::OVNINGS_PAKET => 'Övningspaket',
            self::OVRIGA_TJANSTER => 'Övriga tjänster',
            self::KURSES => 'Kurser',
        ];
    }

    public static function getAliases()
    {
        return [
            self::INTENSIV_PAKET => 'intensive',
            self::OVNINGS_PAKET => 'study',
            self::OVRIGA_TJANSTER => 'other',
            self::KURSES => 'courses',
        ];
    }
}