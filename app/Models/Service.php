<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;  // Include SoftDeletes trait

    protected $fillable = ['title', 'description', 'icon_class', 'is_active'];  // Add is_active to fillable

    // Optional: Define the format for the 'deleted_at' column (soft delete)
    protected $dates = ['deleted_at'];
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

