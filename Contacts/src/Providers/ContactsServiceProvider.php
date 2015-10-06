<?php
namespace BrikaCMS\Modules\Contacts\Providers;

use Lang;
use View;
use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

// Models
use BrikaCMS\Modules\Contacts\Models\Contact;
//use BrikaCMS\Modules\Contacts\Models\ContactTranslation;

// Repo
use BrikaCMS\Modules\Contacts\Repositories\ContactRepository;

use Illuminate\Routing\Router;
use Illuminate\Http\Request;
class ContactsServiceProvider extends ServiceProvider
{



    public function boot(Router $router)
    {
        // Bring in the routes
        // Add dirs
        View::addLocation(__DIR__ . '/../Resources/Views');
        Lang::addNamespace('contacts', __DIR__ . '/../Resources/Lang');
        $router->model('contacts', 'BrikaCMS\Modules\Contacts\Models\Contact');
    }
    public function register()
    {
        $app = $this->app;

        $app->register('BrikaCMS\Modules\Contacts\Providers\RouteServiceProvider');

        $app->bind('BrikaCMS\Modules\Contacts\Repositories\ContactRepositoryInterface', function(Application $app){
            $repository = new ContactRepository(new Contact);
            return $repository;
        });
        require __DIR__ . '/../Resources/breadcrumbs.php';

    }




}