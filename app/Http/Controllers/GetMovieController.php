<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class GetMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $search = ''; // Voeg hier eventueel een zoekterm toe
//
//        $retrieveMovies = function ($search = '') {
//            $apiKey = env('MOVIEDB_API_KEY');
//            $endpoint = 'https://api.themoviedb.org/3/search/movie';
//
//            $response = Http::get($endpoint, [
//                'api_key' => $apiKey,
//                'query' => $search,
//            ]);
//
//            $data = $response->json();
//
//            $movies = collect($data['results'])->map(function ($movie) {
//                $movie['release_date_dutch'] = $movie['release_date'];
//                $movie['backdrop_url'] = 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'];
//                return $movie;
//            })->filter(function ($movie) {
//                return $movie['vote_count'] > 3;
//            })->toArray();
//
//            return $movies;
//        };
//
//        $movies = $retrieveMovies($search);
//
//        // Voer hier verdere bewerkingen uit met de $movies-array
//
//        return $movies;


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $search = $request->input('search');



        $apiKey = Config::get('services.MovieDB.api_key');
        $url = "https://api.themoviedb.org/3/search/movie?api_key=$apiKey&query=$search";

        $response = Http::get($url);
        $data = $response->json();

              $movies = collect($data['results'])->map(function ($movie) {
            $movie['release_date_dutch'] = $movie['release_date'];
            $movie['backdrop_url'] = 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'];
            return $movie;
        })->filter(function ($movie) {
            return $movie['vote_count'] > 20;
        })->toArray();

        return response()->json($movies);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
