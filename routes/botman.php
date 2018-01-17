<?php
use App\Http\Controllers\BotManController;
use Spatie\UptimeMonitor\Models\Monitor;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('call me {name}', function ($bot, $name) {
    $bot->reply('Your name is: ' . $name);
});


$botman->hears('Create {name}', function ($bot, $name) {
     $name  = str_replace('<',$name);
     $name  = str_replace('>',$name);

	Monitor::create([
            'url' => trim($name, '/'),
            'look_for_string' => '',
            'uptime_check_method' =>  'head',
            'certificate_check_enabled' => true,
            'uptime_check_interval_in_minutes' => 60,
        ]);
    $bot->reply('Created checks for ' . $name .' 5 minutes');
});

$botman->hears('Stats {name}', function ($bot) {
    Monitor::all()

    $bot->reply();
});