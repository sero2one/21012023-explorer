<?php

declare(strict_types=1);

use App\Console\Commands\CacheFeeChart;
use App\Models\Transaction;

use App\Services\Cache\FeeCache;
use App\Services\Timestamp;
use Carbon\Carbon;
use function Tests\configureExplorerDatabase;

it('should execute the command', function () {
    configureExplorerDatabase();
    Carbon::setTestNow(Carbon::now());

    $start = Transaction::factory(10)->create([
        'fee'       => '100000000',
        'timestamp' => Timestamp::now()->subDays(365)->unix(),
    ])->sortByDesc('timestamp');

    $end = Transaction::factory(10)->create([
        'fee'       => '200000000',
        'timestamp' => Timestamp::now()->endOfDay()->unix(),
    ])->sortByDesc('timestamp');

    (new CacheFeeChart())->handle($cache = new FeeCache());

    foreach (['day', 'week', 'month', 'quarter', 'year'] as $period) {
        expect($cache->getHistorical($period))->toBeArray();
        expect($cache->getMinimum($period))->toBeFloat();
        expect($cache->getAverage($period))->toBeFloat();
        expect($cache->getMaximum($period))->toBeFloat();
    }
});