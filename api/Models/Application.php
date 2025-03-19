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
        return self::whereNot('status_id', 4)->with('status')->get();
    }

    public static function getApplicationsByParams($params)
    {
        $query = self::query();

        // Search query
        if (!empty($params['q'])) {
            $query->where('company_name', 'like', '%' . $params['q'] . '%')
                ->orWhere('job_title', 'like', '%' . $params['q'] . '%');
        }

        // Sort by date
        if (!empty($params['date_sort'])) {
            $direction = str_ends_with($params['date_sort'], 'desc') ? 'desc' : 'asc';
            $column = str_replace(['_asc', '_desc'], '', $params['date_sort']);

            if ($column === 'apply_date' || $column === 'last_contact_date') {
                $query->orderBy($column, $direction);
            }
        }

        // Filter out 'rejected' status
        if (!empty($params['filter'])) {
            if ($params['filter'] === 'on') {
                $query->whereNot('status_id', 4);
            }
        }

        return $query->get();
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