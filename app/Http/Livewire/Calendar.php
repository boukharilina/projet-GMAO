<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Calendar extends Component
{
    public $events = [];

    public function saveEvent(Request $request)
    {    
  
        Log::info('Request data:', $request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'user' => 'nullable|string|max:255',
            'comment' => 'nullable|string'
        ]);
        Log::info('Validation passed');

        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->user = $request->user;
        $event->comment = $request->comment;
        $event->save();
        
        Log::info('Event created:', $event);

        return response()->json(['success' => true, 'event' => $event]);
    }

    public function loadEvents()
    {
        $this->events = Event::all()->toJson();
    }

    public function render()
    {
        $users = User::whereIn('role', ['technicien', 'ingenieur', 'administrateur'])->get();
        $this->loadEvents();
        return view('livewire.calendar', ['users' => $users]);
    }
}
