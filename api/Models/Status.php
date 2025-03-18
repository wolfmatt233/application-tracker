<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id';

    public function applications()
    {
        return $this->hasMany(Application::class, 'id');
    }
}