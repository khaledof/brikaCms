<?php
namespace BrikaCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use BrikaCMS\Facades\BrikaCMS;
use LaravelLocalization;
use BrikaCMS\Modules\Contacts\Models\Contact;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'BrikaCMS\Modules\Contacts\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('contact', 'BrikaCMS\Modules\Contacts\Models\Contact');

    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->when('admin/contacts*', 'AdminRole');
        $router->bind('contact', function ($value) {
            return Contact::where('id', $value)->first();
        });

        /**
         * API routes
         */
        $router->group([
            'namespace' => $this->namespace,
            'prefix'=>'api'
        ], function($router) {
            $router->post('contacts/batchUpdate', 'ApiContactsController@batchUpdate');
            $router->post('contacts/batchDelete', 'ApiContactsController@batchDelete');
            $router->post('contacts/setOrder', 'ApiContactsController@setOrder');
            $router->resource('contacts', 'ApiContactsController');
        });

        /**
         * Admin routes
         */
        $router->group(['namespace' => $this->namespace,
            'prefix'=>'admin',
            'middleware'=>['auth']
        ], function($router) {
            //List Contact
            $router->get('contacts', [
                'as' => 'contacts',
                'uses' => 'AdminContactsController@getIndex',
                'permission' => 'contacts_manage'
            ]);
            //Create Contact
            $router->get('contacts/create', [
                'as' => 'create_contacts',
                'uses' => 'AdminContactsController@getCreate',
                'permission'=>'contacts_manage'
            ]);
            $router->post('contacts',[
                'as' => 'create_contacts',
                'uses' => 'AdminContactsController@postCreate',
                'permission'=>'contacts_manage'
            ]);
            //Edit Contact
            $router->get('contacts/{id}/edit', [
                'as' => 'edit',
                'uses' => 'AdminContactsController@getEdit',
                'permission'=>'contacts_manage'
            ]);
            $router->post('contacts/{id}',[
                'uses'=>'AdminContactsController@postEdit',
                'permission'=>'contacts_manage'
            ]);
            $router->get('contacts/export', [
                'uses'=>'AdminContactsController@export',
                'permission'=>'contacts_manage']);
            $router->resource('admin/contacts', 'AdminContactsController');
        });
    }
}
