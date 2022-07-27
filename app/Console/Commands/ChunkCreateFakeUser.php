<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserIndexed;
use Illuminate\Console\Command;

class ChunkCreateFakeUser extends Command
{
    public const CHUNK_SIZE = 1000;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:user {num=10}';

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
     * @return int
     */
    public function handle()
    {
        $numberToCreate = (int) $this->argument('num');
        $bar = $this->output->createProgressBar($numberToCreate);
        while ($numberToCreate > 0) {
            $chunkCreateNum = ($numberToCreate > self::CHUNK_SIZE) ? self::CHUNK_SIZE : $numberToCreate;
            User::factory()->count($chunkCreateNum)->create();
            UserIndexed::factory()->count($chunkCreateNum)->create();
            $bar->advance($chunkCreateNum);
            $numberToCreate -= $chunkCreateNum;
        }
        $bar->finish();
    }
}
