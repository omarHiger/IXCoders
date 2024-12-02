<?php

namespace App\Enums;

class TaskStatus
{
    const Pending = 'pending';
    const IN_PROGRESS = 'in-progress';
    const COMPLETED = 'completed';


    public static function getValues()
    {
        return [
            self::Pending,
            self::IN_PROGRESS,
            self::COMPLETED,
        ];
    }
}
