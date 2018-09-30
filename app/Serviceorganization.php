<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Serviceorganization extends Model
{
    use Sortable;

    protected $table = 'service_organization';

    protected $primaryKey = 'id';
    
	public $timestamps = false;

}
