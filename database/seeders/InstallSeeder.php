<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Employee = new Employee();
        $Employee->name = 'admin';
        $Employee->email = 'admin@admin.com';
        $Employee->password = Hash::make('123456');
        $Employee->save();
    }
}
