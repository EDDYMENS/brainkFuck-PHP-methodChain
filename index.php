<?php 
include('brainFuck.php');

$brainFuck = new brainFuck();

$brainFuck
    ->inc(10)

    ->label('blckA')
        ->shiftFwd()->inc(7)
        ->shiftFwd()->inc(10)
        ->shiftFwd()->inc(3)
        ->shiftFwd()->inc(1)
        ->shiftBck(4)->dec()
    ->jmp('blckA')

    ->shiftFwd()->inc(2)->output()
    ->shiftFwd()->inc(1)->output()
    ->inc(7)->output()
    ->output()
    ->inc(3)->output()
    ->shiftFwd()->inc(2)->output()
    ->shiftBck(2)->inc(15)->output()
    ->shiftFwd()->output()
    ->inc(3)->output()
    ->dec(6)->output()
    ->dec(8)->output()
    ->shiftFwd()->inc()->output()
    ->shiftFwd()->output()
    
;


