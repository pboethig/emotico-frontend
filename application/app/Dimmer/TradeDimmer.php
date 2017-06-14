<?php

namespace App\Dimmer;

use Arrilot\Widgets\AbstractWidget;

/**
 * Class TradeDimmer
 * @package App\Dimmer
 */
class TradeDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Models\Trade::all()->count();

        $string = $count == 1 ? 'trades' : 'trades';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => "You have {$count} {$string} in your database. Click on button below to view all trades exxchange.",
            'button' => [
                'text' => 'View all trades',
                'link' => route('voyager.trades.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/04.png'),
        ]));
    }
}
