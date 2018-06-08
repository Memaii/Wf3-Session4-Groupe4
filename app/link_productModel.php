<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class link_productModel extends Model
{
    protected $table = 'link_product';
	protected $primaryKey = 'id_link';
	public $timestamps = false;
}
