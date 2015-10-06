<?php
namespace BrikaCMS\Modules\Contacts\Models;

use BrikaCMS\Models\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Input;
use Route;
use BrikaCMS\Presenters\PresentableTrait;


class Contact extends Base {

    use PresentableTrait;

    protected $table = 'contacts';
    protected $fillable = array(
        'name','email','company','phone','msg','sort_order','published'
    );
    protected $guarded = array();
    public 	  $timestamps = true;

    public $route = 'contacts';
    public $sortBy = 'sort_order';
    public $sortDirection = 'desc';

    protected $presenter = 'BrikaCMS\Modules\Contacts\Presenters\ModulePresenter';

    public function modules()
    {
        return $this->hasMany('BrikaCMS\Modules\Modules\Models\Module');
    }

}
