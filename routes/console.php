<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Schedule;


Schedule::command('grades:calculate')->weekly();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());    
})->purpose('Display an inspiring quote')->hourly();
