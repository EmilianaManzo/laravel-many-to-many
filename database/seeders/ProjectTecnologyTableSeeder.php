<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTecnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 200 ; $i++) {
            // estraggo un progetto random
            $project = Project::inRandomOrder()->first();

            // estraggo un id random dalle tecnologie
            $tecnology_id = Tecnology::inRandomOrder()->first()->id;

            // aggiungo la relazione nella tabella pivot
            $project->tecnologies()->attach($tecnology_id);
        }
    }
}
