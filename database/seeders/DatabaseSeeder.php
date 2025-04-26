<?php

namespace Database\Seeders;

use App\Enums\EnumPostTemplates;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Root',
            'email' => 'root@betterthanadventure.net',
            'password' => Hash::make('root'),
        ]);

        PostType::create(['name' => 'Homepage', 'slug' => 'homepage', 'post_template_enum' => EnumPostTemplates::Page]);
        PostType::create(['name' => 'Blog', 'slug' => 'blog', 'post_template_enum' => EnumPostTemplates::Article]);
        PostType::create(['name' => 'Tutorial', 'slug' => 'tutorials', 'post_template_enum' => EnumPostTemplates::Page]);
        PostType::create(['name' => 'Photos', 'slug' => 'photos', 'post_template_enum' => EnumPostTemplates::Gallery]);
        PostType::create(['name' => 'Videos', 'slug' => 'videos', 'post_template_enum' => EnumPostTemplates::Gallery]);
    }
}
