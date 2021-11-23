<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::find(1);

        if(is_null($setting))
        {
            Setting::create([
                'website_title'         => 'Code Eazy',
                'website_logo_dark'     => '',
                'website_logo_light'    => '',
                'website_logo_small'    => '',
                'website_favicon'       => '',
                'meta_title'            => '',
                'meta_description'      => '',
                'meta_tag'              => '',
                'currency_id'           => 1,
                'address'               => 'Dhaka, Bangladesh',
                'phone'                 => '+8801689201370',
                'email'                 => 'soumik.ahammed.9@gmail.com',
                'facebook'              => 'https://www.facebook.com/soumik.ahammed.9/',
                'twitter'               => 'www.twitter.com/soumik9',
                'linkedin'              => 'https://www.linkedin.com/in/soumik-ahammed-a41915171/',
                'instagram'             => 'https://www.instagram.com/soumik.ahammed.9/',
                'github'                => 'https://github.com/soumik9',
            ]);
        }
    }
}
