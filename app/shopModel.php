<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shopModel extends Model
{
	protected $table = 'shop';
	protected $primaryKey = 'id_shop';
	public $timestamps = false;
}
