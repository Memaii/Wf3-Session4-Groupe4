<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryModel extends Model
{
    protected $table = 'category';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
