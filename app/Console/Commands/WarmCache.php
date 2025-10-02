<?php

namespace App\Console\Commands;

use App\Services\CacheService;
use Illuminate\Console\Command;

class WarmCache extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cache:warm {--force : Force cache warming even if caches exist}';

    /**
     * The console command description.
     */
    protected $description = 'Warm up application caches for better performance';

    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        parent::__construct();
        $this->cacheService = $cacheService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cache warming...');

        try {
            // Warm up critical caches
            $this->cacheService->warmUpCaches();
            
            $this->info('✓ Popular events cached');
            $this->info('✓ Featured events cached');
            $this->info('✓ Events listing cached');
            
            $this->info('Cache warming completed successfully!');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Cache warming failed: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
