<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Servicetaxonomy extends Model
{
    use Sortable;

    protected $table = 'service_taxonomy';

    protected $primaryKey = 'id';
    
	public $timestamps = false;

}
