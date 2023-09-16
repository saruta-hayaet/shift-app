<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // 会社の名前や他のカラムをここに追加

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
