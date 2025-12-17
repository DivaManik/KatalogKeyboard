<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Keyboard;

class VisitorController extends Controller
{
    public function searchView()
    {
        return view('searchView.search');
    }

    public function searchResults(Request $request){
        $text_input = trim($request->input('search'));
        $keyboards = Keyboard::where('name','LIKE',"%{$text_input}%")-> get();
        return view('searchView.searchresults',[
            'text_input' => $text_input,
            'keyboards' => $keyboards,
        ]);
    }
}
