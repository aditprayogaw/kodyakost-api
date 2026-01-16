<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CulturalEvent;

class CulturalEventController extends Controller
{
    public function index()
    {
        $events = CulturalEvent::all();
        return response()->json([
            'success' => true,
            'data' => $events,
        ]);
    }
}
