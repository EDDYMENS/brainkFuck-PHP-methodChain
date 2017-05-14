<?php

include 'brainFuck.php';

$brainFuck = new brainFuck();

$brainFuck
    ->inc(10) //initialize counter (cell #0) to 10

    ->label('blckA') //use loop to set 70/100/30/10
        ->shiftFwd()->inc(7) //add  7 to cell #1
        ->shiftFwd()->inc(10) //add 10 to cell #2
        ->shiftFwd()->inc(3) //add  3 to cell #3
        ->shiftFwd()->inc(1) //add  1 to cell #4
        ->shiftBck(4)->dec() //decrement counter (cell #0)
    ->jmp('blckA')

    ->shiftFwd()->inc(2)->output()     //print 'H'
    ->shiftFwd()->inc(1)->output()     //print 'e'
    ->inc(7)->output()                 //print 'l'
    ->output()                         //print 'l'
    ->inc(3)->output()                 //print 'o'
    ->shiftFwd()->inc(2)->output()     //print ' '
    ->shiftBck(2)->inc(15)->output()   //print 'W'
    ->shiftFwd()->output()			   //print 'o'
    ->inc(3)->output()                 //print 'r'
    ->dec(6)->output()				   //print 'l'
    ->dec(8)->output()				   //print 'd'
    ->shiftFwd()->inc()->output()	   //print '!'
    ->shiftFwd()->output()             //print '\n'

;
