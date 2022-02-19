<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galaxy extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'dimension',
        'number_of_solar_systems'
    ];

    /**
     * The attributes that should be dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get the user that owns the galaxy.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the solar systems for the galaxy.
     */
    public function solarSystems() {
        return $this->hasMany(SolarSystem::class);
    }
}
