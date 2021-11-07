<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function getWorkType() {
        return [
            1 => 'Development',
            2 => 'Maintenance',
        ];
    }

    public function getWorkTypeAttribute()
    {
        return self::getWorkType()[$this->type];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
