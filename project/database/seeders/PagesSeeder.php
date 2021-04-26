<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use App\Models\User;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();

        $admin_user = User::where( 'username', 'admin' )->first();

        Page::create(array(
            'title' => 'About',
            'url' => 'about',
            'content' => 'This is the about page.',
            'user_id' => $admin_user->id,
            'parent_id' => null,
            '_lft' => 3,
            '_rgt' => 6,
        ));

        Page::create(array(
            'title' => 'Contact',
            'url' => 'contact',
            'content' => 'This is the contact page.',
            'user_id' => $admin_user->id,
            'parent_id' => null,
            '_lft' => 1,
            '_rgt' => 2,
        ));

        Page::create(array(
            'title' => 'FAQ',
            'url' => 'another-page',
            'content' => 'This is the another page.',
            'user_id' => $admin_user->id,
            'parent_id' => null,
            '_lft' => 4,
            '_rgt' => 5,
        ));
    }
}
