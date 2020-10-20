<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Facades\Network;
use App\Models\Round;
use App\Services\NumberFormatter;
use Spatie\ViewModels\ViewModel;

final class RoundViewModel extends ViewModel
{
    private Round $model;

    public function __construct(Round $round)
    {
        $this->model = $round;
    }

    public function balance(): string
    {
        return NumberFormatter::currency($this->model->balance / 1e8, Network::currency());
    }
}