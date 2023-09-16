<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'shift_date', 'morning_project_id', 'afternoon_project_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function morningProject()
    {
        return $this->belongsTo(Project::class, 'morning_project_id');
    }

    public function afternoonProject()
    {
        return $this->belongsTo(Project::class, 'afternoon_project_id');
    }
}
