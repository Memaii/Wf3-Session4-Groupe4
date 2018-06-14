<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_category_has_categoryModel extends Model
{
    protected $table = 'sub_category_has_category';
	protected $primaryKey = 'sub_category_id_sub_category';
	public $timestamps = false;
}
