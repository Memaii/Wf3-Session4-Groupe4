<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deliveryModel extends Model
{
    protected $table = 'delivery';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
