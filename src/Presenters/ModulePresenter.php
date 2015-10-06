<?php namespace BrikaCMS\Modules\Contacts\Presenters;

use BrikaCMS\Presenters\Presenter;
use Carbon\Carbon;
use Patchwork\Utf8;

class ModulePresenter extends Presenter
{
    public function added()
    {
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $dt = Carbon::parse($this->created_at);
        return Utf8::ucfirst($dt->formatLocalized('%A %d %B %Y'));
    }
}