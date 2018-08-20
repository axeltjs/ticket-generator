<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    public $timestamps = true;
	use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'picture',
        'extention',
        'start_num',
        'end_num',
        'model_layout',
    ];
    public function getTotalAttribute()
    {
        return $this->getAttribute('num_end') - $this->getAttribute('num_start');
    }
}
