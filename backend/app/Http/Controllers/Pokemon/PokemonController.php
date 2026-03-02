<?php

namespace App\Http\Controllers\Pokemon;

use App\Dto\Pokemon\PokemonDto;
use App\Dto\Pokemon\PokemonFilterDto;
use App\Http\Controllers\Controller;
use App\Models\Pokemon\Pokemon;
use Spatie\LaravelData\PaginatedDataCollection;

class PokemonController extends Controller
{
    public function index(PokemonFilterDto $request): PaginatedDataCollection
    {
        return PokemonDto::collect(
            Pokemon::paginate(10),
            PaginatedDataCollection::class
        )->wrap('data');
    }

    public function show(Pokemon $pokemon): PokemonDto
    {
        return PokemonDto::from($pokemon)->wrap('data');
    }
}
