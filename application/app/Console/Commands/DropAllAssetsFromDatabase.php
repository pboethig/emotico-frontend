<?php

namespace App\Console\Commands;

use App\Models\Asset;
use Illuminate\Console\Command;

class DropAllAssetsFromDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emotico:assets:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Are you sure?'))
        {
            $this->info("Deleting Assets");

            (new Asset())->newQuery()->delete();

            $this->info("All Assets are deleted now.");
        }
    }
}
