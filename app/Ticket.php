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
    public function getTotalFormattedAttribute()
    {
        return $this->getAttribute('end_num') - $this->getAttribute('start_num') + 1;
    }
}
