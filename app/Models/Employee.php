<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id']; // 社員の名前や他のカラムをここに追加

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
