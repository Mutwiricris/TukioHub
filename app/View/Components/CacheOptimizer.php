<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class CacheOptimizer extends Component
{
    public $cacheKey;
    public $duration;
    public $data;

    public function __construct($cacheKey, $duration = 3600, $data = null)
    {
        $this->cacheKey = $cacheKey;
        $this->duration = $duration;
        $this->data = $data;
    }

    public function render()
    {
        return function (array $data) {
            $cacheKey = $this->cacheKey;
            $duration = $this->duration;
            
            return Cache::remember($cacheKey, $duration, function () use ($data) {
                return view('components.cache-optimizer', $data)->render();
            });
        };
    }
}
