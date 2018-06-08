<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentModel extends Model
{
    protected $table = 'payment';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
