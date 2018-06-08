<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    protected $table = 'order';
	protected $primaryKey = 'id';
	public $timestamps = false;
