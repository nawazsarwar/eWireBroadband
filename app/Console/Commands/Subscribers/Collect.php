<?php

namespace App\Console\Commands\Subscribers;

use Illuminate\Console\Command;

class Collect extends Command
{
    protected $signature = 'collect:subscribers';

    protected $description = 'Command description';

    public function handle()
    {
        $this->info("I am running for nasir");
        $this->error("I am done");
        return Command::SUCCESS;
    }
}
