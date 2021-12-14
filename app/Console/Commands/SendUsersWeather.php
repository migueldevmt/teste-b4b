<?php

namespace App\Console\Commands;

use App\Actions\GetClientWeather;
use App\Models\User;
use App\Notifications\NewWeatherInfo;
use Illuminate\Console\Command;

class SendUsersWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teste-b4b:send-users-weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send users weather';

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
        $getClientWeather = resolve(GetClientWeather::class);
        User::whereNotNull("last_ip")->each(function (User $user) use ($getClientWeather) {
            $currentWeather = $getClientWeather->executar($user->last_ip);
            if ($currentWeather) $user->notify(new NewWeatherInfo($currentWeather));
        });
    }
}