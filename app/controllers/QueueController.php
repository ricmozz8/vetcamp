<?php

require_once 'Controller.php';
require_once 'app/models/WaitList.php';

class QueueController extends Controller
{
    public static function queue()
    {
        $waitlist = WaitList::waitQueue();
        self::render('queue', ['waitlist' => $waitlist]);
    }
}


