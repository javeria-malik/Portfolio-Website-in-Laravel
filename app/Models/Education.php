<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'educations';

    protected $fillable = [
        'degree',
        'institution',
        'start_year',
        'end_year',
        'description',
        'is_active',
    ];

    protected $dates = ['deleted_at'];

    // Scope for active records
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for inactive records
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}
