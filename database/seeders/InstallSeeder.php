<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class InstallSeeder extends Seeder
{
    public function run()
    {
        $Employee = new Employee();
        $Employee->name = 'admin';
        $Employee->email = 'admin@admin.com';
        $Employee->password = Hash::make('123456');
        $Employee->save();
        $Settings = [
            [
                'key'=>'mobile',
                'name'=>'رقم الجوال',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],[
                'key'=>'whatsapp',
                'name'=>'رقم الواتس اب',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],[
                'key'=>'email',
                'name'=>'البريد الالكتروني',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],[
                'key'=>'facebook',
                'name'=>'رابط الفيسبوك',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],[
                'key'=>'instagram',
                'name'=>'رابط الانستغرام',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],[
                'key'=>'twitter',
                'name'=>'رابط التويتر',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],[
                'key'=>'linkedin',
                'name'=>'رابط اللينكد ان',
                'value'=>'',
                'type'=>Setting::Types['Contact']
            ],
        ];
        Setting::insert($Settings);
    }
}
