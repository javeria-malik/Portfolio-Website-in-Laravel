<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title',  'image', 'category', 'is_active'];

    // Local scope for active projects
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
