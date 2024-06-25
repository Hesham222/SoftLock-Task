<?php

use Illuminate\Database\Seeder;
use Admin\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'phone' => '0101111002', 'password' => bcrypt(1234567890), 'privileges' => 'super']);
    }
}
