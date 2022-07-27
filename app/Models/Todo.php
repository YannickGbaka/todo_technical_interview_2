<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // defining the fillable fields 
    protected $fillable = [
        'task',
        'priority',
        'state',
    ];

    // Defining some constants for each value of the priority of a particular task;

    const HIGH_PRIORITY = 1;
    const MEDIUM_PRIORITY = 2;
    const LOW_PRIORITY = 3;

    // Function to retrieve the string associated to the priority of the task
    public function getPriorityAttribute($value)
    {
        switch ($value) {
            case Self::HIGH_PRIORITY:
                return 'Elévé';
            case Self::MEDIUM_PRIORITY:
                return 'Moyenne';
            case Self::LOW_PRIORITY:
                return 'Faible';
        }
    }

    // public function getStateAttribute($value)
    // {
    //     return $value == true ? 'Terminé' : 'En cours';
    // }
}
