<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'startDate',
        'endDate',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
{
    return $this->belongsToMany(User::class, 'cour_user', 'cour_id', 'user_id')->withTimestamps();
}
}
