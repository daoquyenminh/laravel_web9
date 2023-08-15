<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birthdate',
        'birthdate',
        'status',
        'course_id',
    ];
    public function getAgeAttribute():int
    {
        return date_diff(date_create($this->birthdate),date_create())->y;
    }
    public function getGenderNameAttribute():string
    {
        return ($this->gender===0) ? "Male" : "Female";
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
