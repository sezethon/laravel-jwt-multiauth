<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('teachers')->insert([
            'name' => '教师A',
            'teacher_card_id' => '81001',
            'mobile' => '13500081001',
            'password' => bcrypt('12345'),
        ]);

        DB::table('teachers')->insert([
            'name' => '教师B',
            'teacher_card_id' => '81002',
            'mobile' => '13500081002',
            'password' => bcrypt('12345'),
        ]);

        DB::table('students')->insert([
            'name' => '学生甲',
            'student_card_id' => '18001',
            'mobile' => '13900018001',
            'password' => bcrypt('12345'),
        ]);

        DB::table('students')->insert([
            'name' => '学生乙',
            'student_card_id' => '18002',
            'mobile' => '13900018002',
            'password' => bcrypt('12345'),
        ]);
    }
}
