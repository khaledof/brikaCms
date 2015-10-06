<?php
namespace BrikaCMS\Modules\Contacts\Repositories;

use Illuminate\Database\Eloquent\Model;
use BrikaCMS\Repositories\RepositoriesAbstract;


class ContactRepository extends RepositoriesAbstract implements ContactRepositoryInterface {

    public function __construct( Model $model )
    {
        $this->model = $model;
    }

    public function getExportAll($with = array())
    {
        $query = $this->make($with);

        $query->select('name as Prénom&Nom','email as Email','company as Société','phone as Téléphone','msg as Message','created_at as date');
        return  $query->get();
    }
    public function getTotal()
    {
        return $this->model->count();
    }
}
