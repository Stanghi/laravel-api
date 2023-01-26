<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $new_project = new Project();
            $new_project->title = $faker->word();
            $new_project->slug = Project::generateSlug($new_project->title);
            $new_project->client_name = $faker->word();
            $new_project->summary = $faker->paragraph(5);
            $new_project->save();
        }
    }
}
