<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        
        DB::table('categories')->insert([
            [
                'name' => '暮らし',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
            [
                'name' => 'お笑い',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
            [
                'name' => '野球',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
            [
                'name' => '音楽',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
            [
                'name' => 'ゲーム',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
            [
                'name' => 'プログラミング',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
            [
                'name' => '大学の勉強',
                'updated_at' => now(),
                'created_at' => now(),
            ],    
        ]);
    }
}
