<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $users = \App\Models\User::with('tasks')->get();
    foreach ($users as $user) {
        dispatch(new \App\Jobs\SendTaskSummaryJob($user));
    }
})->daily();
