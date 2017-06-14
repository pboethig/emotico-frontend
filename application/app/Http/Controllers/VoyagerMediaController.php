<?php

namespace App\Http\Controllers;

/**
 * Class VoyagerMediaController
 * @package App\Http\Controllers
 */
class VoyagerMediaController extends \TCG\Voyager\Http\Controllers\VoyagerMediaController
{
    /** @var string */
    private $filesystem;

    /** @var string */
    private $directory = '';

    public function __construct()
    {
        $this->filesystem = config('voyager.storage.disk');
    }

    public function index()
    {
        $view = parent::index();

        return $view;
    }
}
