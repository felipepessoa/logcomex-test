<?php

namespace Tests\Service;

use App\Dto\Pokemon\Service\PokemonDetailsDto;
use App\Dto\Pokemon\Service\PokemonListDto;
use App\Service\PokemonService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use Spatie\LaravelData\DataCollection;
use Tests\TestCase;

class PokemonServiceTest extends TestCase
{
    public PokemonService $pokemonService;
    public function setUp(): void
    {
        parent::setUp();
        $this->pokemonService = new PokemonService;

    }

    #[Test, TestDox('Pokemon list is fetched successfully')]
    public function getPokemonList()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/pokemon*' => Http::response([
                'count' => 2,
                'next' => 'https://pokeapi.co/api/v2/pokemon?offset=20&limit=20',
                'previous' => null,
                'results' => [
                    ['name'=>'bulbasaur','url'=>'https=>//pokeapi.co/api/v2/pokemon/1/'],
                    ['name'=>'ivysaur','url'=>'https://pokeapi.co/api/v2/pokemon/2/'],
                ],
            ])
        ]);

        $response = $this->pokemonService->getPokemonList();

        $this->assertInstanceOf(PokemonListDto::class, $response);
        $this->assertEquals(2, $response->count);
        $this->assertInstanceOf(DataCollection::class, $response->results);
        $this->assertCount(2, $response->results);
        $this->assertEquals('bulbasaur', $response->results[0]->name);
        $this->assertEquals('ivysaur', $response->results[1]->name);
    }

    #[Test, TestDox('Fetch pokemon details sucessfully')]
    public function getPokemonDetails()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/pokemon/1' => Http::response([
                'name' => 'bulbasaur',
                'types' => [
                    ['type' => ['name' => 'grass']],
                    ['type' => ['name' => 'poison']],
                ],
                'height' => 7,
                'weight' => 69,
            ])
        ]);

        $response = $this->pokemonService->getPokemonDetails(1);

        $this->assertInstanceOf(PokemonDetailsDto::class, $response);
        $this->assertEquals('bulbasaur', $response->name);
        $this->assertEquals('grass', $response->type);
        $this->assertEquals(7, $response->height);
        $this->assertEquals(69, $response->weight);
    }

    #[Test, TestDox('Handles API errors gracefully')]
    public function handlesApiErrors(){
        Http::fake([
            'https://pokeapi.co/api/v2/pokemon*' => Http::response([], 500)
        ]);

        $this->expectException(RequestException::class);

        $this->pokemonService->getPokemonList();
    }

}
