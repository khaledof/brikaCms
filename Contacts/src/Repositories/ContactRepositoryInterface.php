<?php
namespace BrikaCMS\Modules\Contacts\Repositories;

use BrikaCMS\Repositories\RepositoryInterface;

interface ContactRepositoryInterface extends RepositoryInterface
{
    public function getExportAll($with = array());
    public function getTotal();
}