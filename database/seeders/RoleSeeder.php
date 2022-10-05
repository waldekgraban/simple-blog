<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => Role::USER_ROLE]);
        Role::create(['name' => Role::ADMIN_ROLE]);
        Role::create(['name' => Role::EDITOR_ROLE]);
    }
}
