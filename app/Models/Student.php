<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'course_id',
        'address',
        'municipality',
        'province',
        'region',
        'latitude',
        'longitude',
        'campus_id',
        'year',
        'status'
    ];

    public function course_details(): BelongsTo{
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function campus_details(): BelongsTo{
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }
}
