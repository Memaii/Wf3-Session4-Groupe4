<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opinionModel extends Model
{
    protected $table = 'opinion';
	protected $primaryKey = 'id_opinion';
	public $timestamps = false;
}
