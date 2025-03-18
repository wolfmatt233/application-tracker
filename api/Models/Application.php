<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Application extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';

    public function status()
    {
        return $this->belongsTo(Status::class, 'id');
    }

    public static function getApplications()
    {
        return self::with('status')->get();
    }
}