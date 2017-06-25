<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

/**
 * Class EmoticoMenuItemsTableSeeder
 */
class EmoticoMenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (file_exists(base_path('routes/web.php')))
        {
            require base_path('routes/web.php');

            $menu = Menu::where('name', 'admin')->firstOrFail();

            $assetsMenuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Assets',
                'url'        => '',
            ]);

            if (!$assetsMenuItem->exists)
            {
                $assetsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-photos',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 11,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'List',
                'url'        => 'admin/assets',
            ]);

            if (!$menuItem->exists)
            {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => '',
                    'color'      => null,
                    'parent_id'  => $assetsMenuItem->id,
                    'order'      => 12,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id'    => $menu->id,
                'title'      => 'Import',
                'url'        => 'admin/assets/import',
            ]);

            if (!$menuItem->exists)
            {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => '',
                    'color'      => null,
                    'parent_id'  => $assetsMenuItem->id,
                    'order'      => 13,
                ])->save();
            }
        }
    }
}
