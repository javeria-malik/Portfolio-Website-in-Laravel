<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'skills';

    protected $fillable = [
        'title',
        'percentage',
        'is_active',
    ];

    protected $dates = ['deleted_at'];

    // Scope for active records
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for inactive records
    public function getStatusAttribute()
{
    return $this->is_active ? 'Activate' : 'Deactivate';
}
}
