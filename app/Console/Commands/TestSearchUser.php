<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserIndexed;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TestSearchUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:search  {--month=12} {--limit=10} {--times=100}';

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
        $startDateTime = Carbon::now()->subYears(15)->format("Y-m-d H:i:s");
        $endDateTime = Carbon::now()->subYears(15)->addMonths($this->option('month'))->format("Y-m-d H:i:s");

        $userTime = 0;
        $userIndexTime = 0;
        $bar = $this->output->createProgressBar($this->option('times'));
        foreach (range(1, $this->option('times')) as $index) {
            $userTime -= microtime(true);
            User::where([
                [ 'register_at' , '>=', $startDateTime ],
                [ 'register_at' , '<=', $endDateTime ],
            ])->limit($this->option('limit'))->get();
            $userTime += microtime(true);

            $userIndexTime -= microtime(true);
            UserIndexed::where([
                [ 'register_at' , '>=', $startDateTime ],
                [ 'register_at' , '<=', $endDateTime ],
            ])->limit($this->option('limit'))->get();
            $userIndexTime += microtime(true);

            $bar->advance();
        }

        $bar->finish();
        dump('Finish !');
        dump("UserIndexed: $userIndexTime");
        dump("User: $userTime");
        dump('Index will speed up ' . (($userTime / $userIndexTime) * 100 - 100) . '%');
    }
}
