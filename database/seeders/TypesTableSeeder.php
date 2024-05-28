<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions\Helper as Helpy;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 10 ; $i++){
            $new_type = new Type();
            $new_type->name = $faker->word(5, true);
            $new_type->slug = Helpy::createSlug($new_type->name, Type::class);
            $new_type->save();
        }
    }
}
