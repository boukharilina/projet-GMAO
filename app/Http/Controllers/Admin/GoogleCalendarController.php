<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;

class CalendarController extends Controller
{
    public function showEvents()
    {
        try {
            $events = Event::get();
            return view('calendar.index', compact('events'));
        } catch (\Exception $e) {
            return view('calendar.index', ['error' => 'Could not connect to Google Calendar. Please check the logs for more details.']);
        }
    }

}
