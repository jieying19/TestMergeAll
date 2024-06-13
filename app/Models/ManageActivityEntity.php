<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageActivityEntity extends Model
{
    use HasFactory;

    protected $table = "ManageActivityEntity";
    protected $fillable = [
        'activity_id',
        'activity_name',
        'activity_desc',
        'activity_dateTime',
        'activity_studentAge',
        'activity_studentNum',
        'activity_comment',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'attendance', 'activity_id', 'user_id');
    }
}
