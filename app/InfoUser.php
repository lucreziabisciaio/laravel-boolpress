<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    protected $fillable = ["address", "avatar", "phone"];

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
