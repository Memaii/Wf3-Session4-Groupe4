<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recap_orderModel extends Model
{
    protected $table = 'recap_order';
	protected $primaryKey = 'order_id';
	public $timestamps = false;
}
