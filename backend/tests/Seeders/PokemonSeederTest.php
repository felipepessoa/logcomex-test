<?php

namespace Tests\Seeders;

use App\Models\Pokemon\Pokemon;
use Database\Seeders\PokemonSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

class PokemonSeederTest extends TestCase
{
   use RefreshDatabase;

    #[Test, TestDox('PokemonSeeder runs without errors')]
    public function pokemonSeederRuns(){
        $seeder = new PokemonSeeder;

        $seeder->run();

        $this->assertDatabaseCount(Pokemon::class, 60);

        $pokemon = Pokemon::first();
        $this->assertNotNull($pokemon);
        $this->assertNotEmpty($pokemon->name);
        $this->assertNotEmpty($pokemon->type);
        $this->assertGreaterThan(0, $pokemon->height);
        $this->assertGreaterThan(0, $pokemon->weight);
    }
}
