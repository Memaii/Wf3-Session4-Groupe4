<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_categoryModel extends Model
{
  protected $table = 'sub_category';
	protected $primaryKey = 'id_sub_category';
	public $timestamps = false;
}
