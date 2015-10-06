<?php
namespace BrikaCMS\Modules\Contacts\Http\Controllers;

use URL;
use Config;
use Input;
use JavaScript;
use View;
use Request;
use Redirect;
use Log;
use Excel;
use Krucas\Notification\Facades\Notification;
use BrikaCMS\Http\Controllers\AdminController;
use BrikaCMS\Modules\Contacts\Repositories\ContactRepositoryInterface;
use BrikaCMS\Modules\Contacts\Http\Requests\ContactFormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class AdminContactsController extends AdminController {

    /**
     * Contact Model
     * @var model
     */
    protected $model;
    protected $api_base_url;
    protected $module = 'contacts';
    protected $languages = array();


    public function __construct(
        ContactRepositoryInterface $model
    )
    {

        $this->model = $model;
        $this->api_base_url = URL::to('/');
        View::share('module', $this->module);
    }

    /**
     * Show a list of all contacts
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = 'Boite de réception';
        try {
            $page = Input::get('page', 1);
            $limit = Input::get('limit', 10);
            $sortBy = Input::get('sortBy', 'created_at');
            $sortDirection = Input::get('sortDirection', 'desc');

            $data = $this->model->getByPage($page, $limit, $sortBy,$sortDirection,[]);
            $totalItems = $data->totalItems;
            $limit = $data->limit;

            $models = new Paginator($data->items, $data->totalItems, $data->limit, $page, ['path' => Paginator::resolveCurrentPath()]);

        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
            exit;
        }
        JavaScript::put([
            'locale' => LaravelLocalization::setLocale(),
            'collection' => $models->getcollection()->toJson(),
        ]);
        $data = array(
            'title' => $title,
            'models' => $models,
            'modelBreacrumbs'=>'',
            'totalItems' => $totalItems,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
            'routes' => array(
                'create' => 'admin/contacts/create',
                'export' => 'admin/contacts/export',
            ),
        );
        // Show the page
        return View::make('admin.index', $data);
    }
    /**
     * Show a list of all contacts By Parent
     *
     * @return View
     */
    public function getIndexByParent($parent_id)
    {
        // Title
        $title = 'Boite de réception';
        try {
            $page = Input::get('page', 1);
            $limit = Input::get('limit', 10);
            $sortBy = Input::get('sortBy', 'sort_order');
            $sortDirection = Input::get('sortDirection', 'desc');

            $data = $this->model->getByPage($page, $limit, $sortBy,$sortDirection,[]);
            $totalItems = $data->totalItems;
            $limit = $data->limit;

            $models = Paginator::make($data->items, $data->totalItems, $data->limit);

        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
            exit;
        }
        JavaScript::put([
            'locale' => LaravelLocalization::setLocale(),
            'collection' => $models->getcollection()->toJson(),
        ]);
        $data = array(
            'title' => $title,
            'models' => $models,
            'totalItems' => $totalItems,
            'limit' => $limit,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
            'routes' => array(
                'create' => 'admin/contacts/create',
            ),
        );
        // Show the page
        return View::make('admin.index', $data);
    }

    public function getEdit($id)
    {
        // Title
        $title = 'Boite de réception';
        try {
            $model = $this->model->findById($id);
        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
            exit;
        }
        JavaScript::put([
            'locale' => LaravelLocalization::setLocale(),
            'model' => (array)$model,
        ]);

        $data = array(
            'action' => 'edit',
            'title' => $title,
            'uriModule' => URL::to('/admin/contacts'),
            'model' => $model,
        );
        // Show the page
        return View::make('admin.edit', $data);
    }

    public function postEdit($id,ContactFormRequest $request)
    {
        $request->merge(['id'=>$id]);
        if ($this->model->update($request->all())) {
            Notification::container()->success(trans('contacts::global.update.success'));
            return Redirect::to('/admin/contacts/'. $id.'/edit');
        }
        else
        {
            Notification::container()->error(trans('contacts::global.update.error'));
            return Redirect::to('/admin/contacts/'. $id.'/edit');
        }
    }

    public function getCreate()
    {
        // Title
        $title = 'Boite de réception';

        JavaScript::put([
            'locale' => LaravelLocalization::setLocale(),
        ]);

        $data = array(
            'action' => 'add',
            'title' => $title,
            'uriModule' => route('create_contacts'),
            'contact' => array(),
        );
        // Show the page
        return View::make('admin.create', $data);
    }

    public function postCreate(ContactFormRequest $request)
    {
        $model = $this->model->create($request->all());
        if($model)
        {
            Notification::container()->success(trans('contacts::global.create.success'));
            return Redirect::to('/admin/contacts/'. $model->id.'/edit');
        }
        else
        {
            Notification::container()->error(trans('contacts::global.create.error'));
            return Redirect::to('/admin/contacts/create');
        }
    }

    public function export()
    {
        $model = $this->model->getExportAll()->toArray();
        Excel::create('Export-Contacts', function($excel) use($model) {
            $excel->sheet('Sheetname', function($sheet) use($model) {
                $sheet->fromModel($model);

            });

        })->export('xls');

    }
}
