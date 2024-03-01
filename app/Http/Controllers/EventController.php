<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        $events = Event::orderByDesc('published_at')->paginate(10);
        return response()->json(['events' => $events]);
    }

    public function getAllByCategory($category_id){
        $events = Event::where('category_id', $category_id)->orderByDesc('published_at')->get();
        return response()->json(['events' => $events]);
    }

    public function getEventById($eventId)
    {
        $event = Event::findOrFail($eventId);
        return response()->json([
            'event' => $event,
        ]);
    }

    public function eventsByCategory($category_id){
        $events = Event::where('category_id', $category_id)->orderByDesc('published_at')->paginate(10);
        return response()->json(['events' => $events]);
    }
}
