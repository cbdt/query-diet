<?php

namespace Cbdt\QueryDiet;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Event;

class QueryDiet
{
    private int $queryCount = 0;

    private int $queryTime = 0;

    public function __construct(private ?Application $app = null)
    {
        if (! $this->app) {
            $this->app = app();
        }
    }

    public function register(): void
    {
        $this->listenToQueryExecuted();
    }

    private function listenToQueryExecuted(): void
    {
        Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
            if (! $this->enabled()) {
                return;
            }
            $this->queryCount++;
            $this->queryTime += $query->time;
        });
    }

    /**
     * Modify the given response to include the widget.
     */
    public function modifyResponse($response): void
    {
        if (! $this->enabled()) {
            return;
        }
        $response->setContent(
            str_replace(
                '</body>',
                $this->widget().'</body>',
                $response->getContent()
            )
        );
    }

    private function getCss(): string
    {
        return <<<'CSS'
.qd-widget-container {
    position: fixed;
    top: 0.25rem;
    right: 0.25rem;
    padding: 5px 10px;
    font-family: monospace;
    z-index: 9999;
}

.qd-widget-container--bad {
    background-color: #f44336;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
}

.qd-widget-container--good {
    background-color: #dadada;
    color: black;
    font-size: 14px;
    font-weight: 500;
}
CSS;

    }

    public function widget(): string
    {
        $goodOrBadClass = $this->isBad() ? 'qd-widget-container--bad' : 'qd-widget-container--good';

        return <<<HTML
<style>
{$this->getCss()}
</style>
<div class="qd-widget-container {$goodOrBadClass}"
onclick="prompt('To explore the queries, use laravel-debugbar or telescope', 'https://github.com/barryvdh/laravel-debugbar' )">
{$this->queryCount}#{$this->queryTime}ms
</div>
HTML;
    }

    /**
     * This is a very simple heuristic to determine if the number of queries or the time taken is bad.
     */
    private function isBad(): bool
    {
        return $this->queryCount > $this->badQueryCount() || $this->queryTime > $this->badQueryTimeMs();
    }

    private function badQueryCount(): int
    {
        return $this->app['config']->get('query-diet.bad_query_count', 10);
    }

    private function badQueryTimeMs(): int
    {
        return $this->app['config']->get('query-diet.bad_query_time_ms', 100);
    }

    /**
     * Determine if the widget should be enabled.
     */
    public function enabled(): bool
    {
        $config = $this->app['config'];
        $configEnabled = value($config->get('query-diet.enabled'));

        if ($configEnabled === null) {
            $configEnabled = $config->get('app.debug');
        }

        return $configEnabled && ! $this->app->runningInConsole() && ! $this->app->environment('testing');
    }
}
