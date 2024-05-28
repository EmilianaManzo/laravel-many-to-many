<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions\Helper as Helpy;
use App\Models\Project;
use App\Models\Type;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(Faker $faker): void
    {
        for ($i=0; $i < 60 ; $i++) {
            $new_project = new Project();

            // va inserita qui perchè nel migration l'abbiamo inserita dopo l'id
            // associamo in modo random partendo dal primo l'id della tabella di types
            $new_project->type_id = Type::inRandomOrder()->first()->id;

            $new_project->title = $faker->word(9, true);
            $new_project->slug = Helpy::createSlug($new_project->title, Project::class);
            $new_project->href =$faker->url();
            $new_project->description =$faker->paragraph(8, true);
            $new_project->save();
        }
    }

}
