<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'HTML',
            'CSS',
            'JS',
            'PHP'
        ];

        foreach ($data as $el) {
            $new_type = new Type();
            $new_type->name = $el;
            $new_type->slug = Str::slug($el);
            $new_type->save();
        }
    }
}
