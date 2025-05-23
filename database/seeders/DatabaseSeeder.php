<?php

namespace Database\Seeders;

use App\Enums\EnumPostTemplates;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $this->createCrudPermissions('posts');
        $this->createCrudPermissions('infographics', ['view', 'create', 'delete']);


        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['posts.create', 'posts.edit', 'posts.delete', 'posts.view']);
        $role->givePermissionTo(['infographics.create', 'infographics.delete', 'infographics.view']);

        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo(['posts.create', 'posts.edit', 'posts.delete', 'posts.view']);

        $role = Role::create(['name' => 'artist']);
        $role->givePermissionTo(['posts.create', 'posts.edit', 'posts.delete', 'posts.view']);
        $role->givePermissionTo(['infographics.create', 'infographics.delete', 'infographics.view']);

        $user = User::factory()->create([
            'name' => 'Root',
            'email' => 'root@betterthanadventure.net',
            'password' => Hash::make('root'),
        ]);

        $user->assignRole('admin');

        $home = PostType::create(['name' => 'Homepage', 'slug' => 'homepage', 'post_template_enum' => EnumPostTemplates::Page]);
        PostType::create(['name' => 'Blog', 'slug' => 'blog', 'post_template_enum' => EnumPostTemplates::Article]);
        PostType::create(['name' => 'Page', 'slug' => 'page', 'post_template_enum' => EnumPostTemplates::Page]);
        PostType::create(['name' => 'Photos', 'slug' => 'photos', 'post_template_enum' => EnumPostTemplates::Gallery]);
        PostType::create(['name' => 'Videos', 'slug' => 'videos', 'post_template_enum' => EnumPostTemplates::Gallery]);

        Post::create([
            'title' => 'Homepage',
            'slug' => 'homepage',
            'summary' => '',
            'content' => '',
            'published_at' => now(),
            'author_id' => $user->id,
            'post_type_id' => $home->id
        ]);
    }

    protected function createCrudPermissions(string $model_name, array $crud = ['view', 'edit', 'create', 'delete']): void {
        if(in_array('create', $crud))
            Permission::create(['name' => "$model_name.create"]);
        if(in_array('edit', $crud))
            Permission::create(['name' => "$model_name.edit"]);
        if(in_array('delete', $crud))
            Permission::create(['name' => "$model_name.delete"]);
        if(in_array('view', $crud))
            Permission::create(['name' => "$model_name.view"]);
    }
}

