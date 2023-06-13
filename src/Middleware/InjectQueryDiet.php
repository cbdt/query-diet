<?php

namespace Cbdt\QueryDiet\Middleware;

use Cbdt\QueryDiet\QueryDiet;

class InjectQueryDiet
{
    public function __construct(private QueryDiet $queryDiet)
    {
    }

    public function handle($request, \Closure $next)
    {
        $this->queryDiet->register();
        $response = $next($request);
        $this->queryDiet->modifyResponse($response);

        return $response;
    }
}
