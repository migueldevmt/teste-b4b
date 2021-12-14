<?php

namespace Tests\Unit;

use App\Actions\GetClientWeather;
use App\Models\User;
use App\Notifications\NewWeatherInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendUsersWeatherTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_command_will_send_email_to_user_and_log_action()
    {
        $user = User::factory()->create();
        Auth::login($user);

        Notification::fake();

        Artisan::call('teste-b4b:send-users-weather');
        Notification::assertSentTo($user, NewWeatherInfo::class, function ($notification, $channels) {
            return in_array('mail', $channels);
        });

        $now = now()->format("Y-m-d");
        $contents = file_get_contents("storage/logs/laravel-$now.log");
        $this->assertNotFalse(strpos($contents, GetClientWeather::class));
        $this->assertNotFalse(strpos($contents, NewWeatherInfo::class));
        $this->assertNotFalse(strpos($contents, $user->name));
    }
}