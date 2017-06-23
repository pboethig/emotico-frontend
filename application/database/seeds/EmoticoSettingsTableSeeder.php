<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class EmoticoSettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $setting = $this->findSetting('title');

            $setting->fill([
                'display_name' => 'Site Title',
                'value'        => 'Emotico',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ])->save();

        $setting = $this->findSetting('description');
            $setting->fill([
                'display_name' => 'Site Description',
                'value'        => 'Emotico Brandsolutions',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
            ])->save();

        $setting = $this->findSetting('logo');
            $setting->fill([
                'display_name' => 'Site Logo',
                'value'        => 'settings/June2017/SW03jxrIfYhNiAtL9wNp.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 3,
            ])->save();

        $setting = $this->findSetting('admin_bg_image');
            $setting->fill([
                'display_name' => 'Admin Background Image',
                'value'        => 'settings/June2017/ExxuMgjcnZSGIAmKYOFr.jpg',
                'details'      => '',
                'type'         => 'image',
                'order'        => 9,
            ])->save();

        $setting = $this->findSetting('admin_title');
            $setting->fill([
                'display_name' => 'Admin Title',
                'value'        => 'Emotico',
                'details'      => '',
                'type'         => 'text',
                'order'        => 4,
            ])->save();

        $setting = $this->findSetting('admin_description');
            $setting->fill([
                'display_name' => 'Admin Description',
                'value'        => 'Welcome to Emotico. Your brands - made easy',
                'details'      => '',
                'type'         => 'text',
                'order'        => 5,
            ])->save();

        $setting = $this->findSetting('admin_loader');
            $setting->fill([
                'display_name' => 'Admin Loader',
                'value'        => 'settings/June2017/G5w2Sw3ThKC6zf8weebc.gif',
                'details'      => '',
                'type'         => 'image',
                'order'        => 6,
            ])->save();

        $setting = $this->findSetting('admin_icon_image');
            $setting->fill([
                'display_name' => 'Admin Icon Image',
                'value'        => 'settings/June2017/ejQzCcb6UD6viDLzBxGu.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 7,
            ])->save();
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
