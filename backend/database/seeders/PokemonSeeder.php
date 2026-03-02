<?php

namespace Database\Seeders;

use App\Dto\Pokemon\Service\PokemonDetailsDto;
use App\Dto\Pokemon\Service\PokemonListDto;
use App\Helpers\ConvertMeasurements;
use App\Models\Pokemon\Pokemon;
use App\Service\PokemonService;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    private PokemonService $service;

    public function run(): void
    {
        $this->service = new PokemonService();

        $list = $this->fetchPokemonListData();
        for($i = 0; $i <=2; $i++) {
            foreach ($list->results as $item) {
                $details = $this->fetchPokemonDetailsData($item->url);
                $this->savePokemonData($details);
            }

            $list = $this->fetchPokemonListData($list->next);
        }
    }

    private function fetchPokemonListData(?string $url = null): PokemonListDto
    {
        return $this->service->getPokemonList($url);
    }

    private function fetchPokemonDetailsData(string $url): PokemonDetailsDto
    {
        return $this->service->getPokemonDetails($url);
    }

    private function savePokemonData(PokemonDetailsDto $dto): void
    {
        $pokemon = Pokemon::query()->make([
            'name' => $dto->name,
            'type' => $dto->type,
            'height' => ConvertMeasurements::feetToCentimeters($dto->height),
            'weight' => ConvertMeasurements::poundsToKilograms($dto->weight),
        ]);

        $pokemon->save();
//        $this->command->info("Saved Pokemon: {$dto->name}");
    }
}
