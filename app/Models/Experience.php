<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'experiences';

    protected $fillable = [
        'title',
        'company',
        'position',
        'description',
        'start_date',
        'end_date',
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
