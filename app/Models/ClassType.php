<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'minuts',
    ];
    public function scheduledClasses(){
        return $this->hasMany(ScheduledClass::class);
    }
}
