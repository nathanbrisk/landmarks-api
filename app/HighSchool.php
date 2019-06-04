<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class HighSchool extends Model
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function __construct()
    {
        if (App::environment('testing')) {
            $this->connection = 'sqlite';
        } else {
            $this->connection = 'mysql';
        }
    }

    public function newCollection(array $models = [])
    {
        return new HighSchoolsCollection($models);
    }
}
