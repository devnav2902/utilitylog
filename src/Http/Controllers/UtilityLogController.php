<?php

namespace Devnav2902\Utilitylog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class UtilityLogController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'date_format:Y-m-d'
        ]);

        $filename = storage_path('logs/laravel.log');

        if($request->has('date')) {
            $filename = storage_path('logs/laravel-'.$request->query('date').'.log');
        }

        $log = '';

        if(file_exists($filename)) {
            $log = File::get($filename);
            $filename = explode('/', $filename)[1];
        } else {
            $filename = null;
        }

        return view('utilitylog::view-log', compact('log', 'filename'));
    }
}
