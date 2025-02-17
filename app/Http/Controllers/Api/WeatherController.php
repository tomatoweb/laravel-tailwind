<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(Weather $weather): array
    {
        return [
            'weather' => $weather->isSunnyTommorow() ? 'sunny' : 'not sunny',
        ];
    }
}
