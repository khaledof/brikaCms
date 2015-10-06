<?php
namespace BrikaCMS\Modules\Contacts\Http\Controllers;

use Config;
use URL;
use Input;
use Request;
use Response;
use Exception;
use Log;
use BrikaCMS\Http\Controllers\ApiController;
use BrikaCMS\Modules\Contacts\Repositories\ContactRepositoryInterface;

class ApiContactsController extends ApiController {

    /**
     * Contact Model
     * @var model
     */
    protected $model;

    /**
     * Inject the models.
     * @param ContactRepositoryInterface $model
     */
    public function __construct(ContactRepositoryInterface $model)
    {
        parent::__construct();
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = Input::get('page', 1);
        $limit = Input::get('limit', 10);
        $sortBy = Input::get('sortBy', 'sort_order');
        $sortDirection = Input::get('sortDirection', 'asc');

        $all = Input::get('all', false);

        if(!$all)
        {
            $data = $this->model->getByPage($page, $limit, $sortBy,$sortDirection,[]);
        }
        else
        {
            // Grab all the contacts
            $data = $this->model->getAll($sortBy,$sortDirection);
        }

        return Response::json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Request::instance();
        $content = $request->getContent();
        $inputs = json_decode($content,true);

        try
        {
            $contact = $this->model->create($inputs);
            if($contact)
            {
                return Response::json(array(
                    'insertedId'=>$contact->id
                ),201);
            }
        }
        catch(Exception $e){
            return Response::json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        try
        {
            $model = $this->model->findById($id,[]);
        }
        catch(Exception $e){
            $response = array(
                "jsonrpc" => "2.0",
                "error" => array("code" => -32600, "message" => "Model not found"),
                "id" => null
            );
            return Response::json($response);
        }
       return Response::json($model, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $request = Request::instance();
        $content = $request->getContent();
        $data = json_decode($content,true);
        $data['id'] = $id['id'];
        try
        {
            $this->model->update($data);
            return Response::json($data);
        }
        catch(Exception $e){
            return Response::json($e->getMessage(), 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $model = $this->model->findById($id);
            if($model){
                $this->model->delete($model);
            }
            else
            {

            }
        }
        catch(Exception $e){
            return Response::json($e->getMessage(), 400);
        }
    }

    public function batchDelete()
    {
        try
        {
            $request = Request::instance();
            $content = $request->getContent();
            $items = explode(',',$content);
            if(!empty($items))
            {
                foreach($items as $item)
                {
                    $model = $this->model->findById($item);
                    if($model)
                    {
                        $this->model->delete($model);
                    }
                }
            }

            return Response::json($items);
        }
        catch(Exception $e){
            return Response::json($e->getMessage(), 400);
        }
    }

    public function setOrder()
    {
        $request = Request::instance();
        $content = $request->getContent();
        $response = json_decode( $content);
        $oldOrder = explode(',', $response->oldOrder);
        $newOrder = explode(',', $response->newOrder);

        if(!empty($oldOrder) && !empty($newOrder))
        {
            foreach($newOrder as $key => $value)
            {
                $item = $this->model->findById($oldOrder[$key]);
                if($item)
                {
                    $sort_order = (isset($item->sort_order)) ? $item->sort_order : 0;
                    $items[] = array(
                        'id' => $value,
                        'sort_order' => $sort_order,
                    );
                }
            }
        }

        if(!empty($items))
        {
            foreach($items as $item)
            {
                $updated = $this->model->update((array)$item);
                if($updated){
                    $result[] = 'ok';
                }

            }
        }
        return Response::json($result);
    }

    public function batchUpdate()
    {
        $request = Request::instance();
        $content = $request->getContent();
        $items = json_decode( $content);

        $result = array();

        if(!empty($items))
        {
            foreach($items as $item)
            {
                $updated = $this->model->update((array)$item);
                if($updated){
                    $result[] = $item;
                }

            }
        }
        return Response::json($result);
    }
}
