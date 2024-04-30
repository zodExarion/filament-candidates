<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'name'=> 'English',
                'level'=> '1',
            ],
            [
                'name'=> 'Polish',
                'level'=> '2',
            ]
        ];

        foreach ($languages as $language) {
           Language::create($language);
        }
    }
}
