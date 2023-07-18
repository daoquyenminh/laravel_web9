<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birhdate',
        'status'
    ];
    public function getAgeAttribute(){
        return date_diff(date_create($this->birthdate),date_create())->y;
    }
}
