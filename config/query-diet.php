<?php

// config for QueryDiet
return [
    'enabled' => env('QUERY_DIET_ENABLED', true),
    'bad_query_time_ms' => env('QUERY_DIET_BAD_QUERY_TIME_MS', 100),
    'bad_query_count' => env('QUERY_DIET_BAD_QUERY_COUNT', 10),
];
