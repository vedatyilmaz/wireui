<?php

use function Livewire\Volt\{state, rules};

state(['checkbox' => false]);

$validateCheckbox = fn() => $this->validate();

rules(['checkbox' => 'accepted'])->messages([
    'checkbox.accepted' => 'accept it',
]);

?>

<div>
    <h1>Checkbox Test</h1>

    <span dusk="checkbox">@json($checkbox)</span>

    // test it_should_render_with_label_and_change_value
    <x-checkbox label="Remember me" wire:model.live="checkbox" />

    <button wire:click="validateCheckbox" dusk="validate">validate</button>
</div>
