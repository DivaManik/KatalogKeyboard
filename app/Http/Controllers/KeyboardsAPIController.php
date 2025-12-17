<?php

namespace App\Http\Controllers;

use App\Keyboard;

use Illuminate\Http\Request;

class KeyboardsAPIController extends Controller
{
    public function apiKeyboards()
    {
        $keyboards = Keyboard::orderBy('id','ASC')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Keyboards',
            'data'    => $keyboards
        ],200);
    }
}
