<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\student;

class rombel extends Model
{
    use HasFactory;
    protected $fillable = [
        'rombel',
    ];

    public function student(){
        return $this->hasMany(student::class);
    }
}
