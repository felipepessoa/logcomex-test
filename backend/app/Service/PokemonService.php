<?php

namespace App\Service;

use App\Dto\Pokemon\Service\PokemonDetailsDto;
use App\Dto\Pokemon\Service\PokemonListDto;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Log;

class PokemonService
{
    public function getPokemonList(?string $page = null): PokemonListDto
    {
        $url ??= 'https://pokeapi.co/api/v2/pokemon';

        $response = Http::get($url)
            ->throw(function (Response $response, $e){
                Log::error("Failed to fetch Pokemon details from: {$e->getMessage()}");
            })
            ->json();

        return PokemonListDto::from($response);
    }

    public function getPokemonDetails(string $url): PokemonDetailsDto
    {
        $response = Http::get($url)
            ->throw(function (Response $response, $e){
                Log::error("Failed to fetch Pokemon details from: {$e->getMessage()}");
            })
            ->json();


        return PokemonDetailsDto::fromApi($response);
    }
}
