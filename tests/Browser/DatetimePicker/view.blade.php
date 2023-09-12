<?php

use function Livewire\Volt\{state, mount};
use Illuminate\Support\Carbon;

state([
    'date' => null,
    'model' => '2021-12-15 10:30',
    'dateAndTime' => '2021-12-25 00:00',
    'utcTimezone' => '2021-07-22 00:30',
    'customFormat' => '29-2021-09 59:13',
    'tokyoTimezone' => '2021-07-26 10:00',
    'withoutTimezone' => '2021-05-22T02:48',
]);

mount(function () {
    $this->date = Carbon::parse('2021-12-15 10:30');
});

?>

<div>
    <h1>LiveTest</h1>

    // test it_should_select_date_without_timezone_difference
    <div id="withoutTimezone">
        <x-datetime-picker
            wire:model.live="withoutTimezone"
            without-timezone
            label="Without Timezone"
            display-format="YYYY-MM-DD HH:mm"
        />
        <span dusk="withoutTimezone">{{ $withoutTimezone }}</span>
    </div>

    // test it_should_select_date_with_utc_timezone_difference
    <div id="utcTimezone">
        <x-datetime-picker
            wire:model.live="utcTimezone"
            label="UTC Timezone"
            {{-- the user's timezone is automatic, but I need to mock the timezone in the tests --}}
            user-timezone="America/Sao_Paulo"
            display-format="YYYY-MM-DD HH:mm"
        />
        <span dusk="utcTimezone">{{ $utcTimezone }}</span>
    </div>

    // test it_should_select_date_with_default_timezone_and_auto_user_timezone
    <div id="tokyoTimezone">
        <x-datetime-picker
            wire:model.live="tokyoTimezone"
            timezone="Asia/Tokyo"
            {{-- the user's timezone is automatic, but I need to mock the timezone in the tests --}}
            user-timezone="America/Sao_Paulo"
            label="Asia/Tokyo Timezone"
            display-format="YYYY-MM-DD HH:mm"
        />
        <span dusk="tokyoTimezone">{{ $tokyoTimezone }}</span>
    </div>

    // test it_should_parse_date_in_custom_format
    <div id="customFormat">
        <x-datetime-picker
            wire:model.live="customFormat"
            parse-format="DD-YYYY-MM mm:HH"
            without-timezone
            label="Custom Format Parse"
            display-format="DD-YYYY-MM mm:HH"
        />
        <span dusk="customFormat">{{ $customFormat }}</span>
    </div>

    // test it_should_select_date_and_time
    <div id="dateAndTime">
        <x-datetime-picker
            wire:model.live="dateAndTime"
            without-timezone
            label="Date and Time"
            display-format="DD-MM-YYYY HH:mm"
        />
        <span dusk="dateAndTime">{{ $dateAndTime }}</span>
    </div>

    <h1>MinMaxLimitsTest</h1>

    <div id="minMaxLimits">
        <x-datetime-picker
            wire:model.live="model"
            without-timezone
            :min="$date->copy()->subDays(7)->setHour(12)->toISOString()"
            :max="$date->copy()->addDays(7)->setHour(15)->toISOString()"
        />
        <span dusk="value">{{ $model }}</span>
    </div>
</div>
