<?php

namespace App\Http\Controllers;
use App\Article;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    // 1. De applicatie moet een landingspagina hebben waarop het hotel wordt ingeleid.
    // In other words: get the article with all its paragraphs and return it in JSON
    function getHomepage(){

        $articles = DB::table('articles')->where('page', 'home')->get();
//        TODO: make sure paragraphs are loaded with the request
        return response()->json([
            'results' => $articles,
        ]);
    }
}
