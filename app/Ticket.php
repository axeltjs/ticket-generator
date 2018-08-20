<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function getTotalAttribute()
    {
        return $this->getAttribute('num_end') - $this->getAttribute('num_start');
    }
}
