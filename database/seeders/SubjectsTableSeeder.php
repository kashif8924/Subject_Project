<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['name' => 'Mathematics'],
            ['name' => 'Science'],
            ['name' => 'History'],
            ['name' => 'English'],
            ['name' => 'Computer Science'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Biology'],
            ['name' => 'Geography'],
            ['name' => 'Art'],
            ['name' => 'Music'],
            ['name' => 'Literature'],
            ['name' => 'Physical Education'],
            ['name' => 'Economics'],
            ['name' => 'Business Studies'],
            ['name' => 'Accounting'],
            ['name' => 'Psychology'],
            ['name' => 'Sociology'],
            ['name' => 'Philosophy'],
            ['name' => 'Political Science'],
        ];
        
        DB::table('subjects')->insert($subjects);
    }
}
