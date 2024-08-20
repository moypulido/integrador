<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($date, $timezone = 'Etc/GMT+6', $format = 'd M Y H:i')
    {
        return $date ? Carbon::parse($date)->setTimezone($timezone)->translatedFormat($format) . ' hs' : 'N/A';
    }
}

function formatDates($object, $timezone = 'Etc/GMT+6', $format = 'd M Y H:i')
{
    $expectedKeys = [
        'date_shipped',
        'date_returned',
        'date_delivered',
        'date_first_visit',
        'date_not_delivered',
        'date_cancelled',
        'date_handling',
        'date_ready_to_ship'
    ];

    foreach ($expectedKeys as $key) {
        if (isset($object->$key) && ($object->$key instanceof \DateTime || strtotime($object->$key) !== false)) {
            $object->$key = Carbon::parse($object->$key)->setTimezone($timezone)->translatedFormat($format) . ' hs';
        } else {
            $object->$key = 'N/A';
        }
    }

    return $object;
}
