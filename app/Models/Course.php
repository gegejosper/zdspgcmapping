<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
        'status',
    ];
    public function accounts_list(){
        return $this->hasMany('App\Models\AccountList', 'account_id', 'id');
    }
}
