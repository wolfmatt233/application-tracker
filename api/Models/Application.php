<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public static function getApplications()
    {
        return self::with('status')->get();
    }

    public static function getApplicationById($id)
    {
        return self::where('id', $id)->with('status')->first();
    }

    public static function createApplication($body)
    {
        $application = new Application();
        $application->company_name = $body['company_name'];
        $application->job_title = $body['job_title'];
        $application->job_description = $body['job_description'];
        $application->apply_date = $body['apply_date'];
        $application->last_contact_date = $body['last_contact_date'];
        $application->status_id = $body['status'];
        $application->location = $body['location'];
        $application->platform = $body['platform'];
        $application->notes = $body['notes'];
        $application->save();

        return $application;
    }

    public static function updateApplication($id, $body)
    {
        $application = self::where('id', $id)->first();

        foreach ($body as $field => $value) {
            $value = trim(preg_replace('/\t+/', '', $value));
            $application->$field = $value;
        }

        $application->save();

        return $application;
    }
}