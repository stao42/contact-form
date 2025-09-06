<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // カテゴリーデータを挿入
        $this->call(CategorySeeder::class);
        
        // 35件のダミーデータを作成
        Contact::factory(35)->create();
    }
}
