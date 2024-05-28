<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions\Helper as Helpy;
use App\Models\Tecnology;

class TecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i <10  ; $i++){
            $new_tec = new Tecnology();
            $new_tec->name = $faker->word(5, true);
            $new_tec->slug = Helpy::createSlug($new_tec->name, Tecnology::class);
            $new_tec->save();
        }
    }
}
