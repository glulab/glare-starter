<?php

namespace Database\Seeders;

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
        \Eloquent::unguard();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // delete media
        // $disk = \Storage::disk('public');
        // $dirs = $disk->directories('media');
        // foreach ($dirs as $dir) {
        //     $disk->deleteDirectory($dir);
        // }

        // $this->call(UserSeeder::class);
        // $this->call(LitUserSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
