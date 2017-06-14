<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\FormFields\After\DescriptionHandler;
use TCG\Voyager\Facades\Voyager as VoyagerFacade;

class EmoticoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFormFields();
    }

    protected function registerFormFields()
    {
        $formFields = [
            'emotico_thumbnail_list',
        ];

        foreach ($formFields as $formField)
        {
            $class = studly_case("{$formField}_handler");

            VoyagerFacade::addFormField("App\\FormFields\\{$class}");
        }

        VoyagerFacade::addAfterFormField(DescriptionHandler::class);

        event('voyager.form-fields.registered');
    }

}
