<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
 
class Club extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name', 'slug', 'city', 'area', 'icon', 'established_year',
        'member_count', 'specialty', 'is_verified', 'is_champion',
        'description', 'contact_phone', 'contact_email', 'is_active',
    ];
 
    protected $casts = [
        'is_verified' => 'boolean',
        'is_champion' => 'boolean',
        'is_active' => 'boolean',
    ];
 
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
 
    public function getAgeAttribute(): int
    {
        return now()->year - $this->established_year;
    }
}
 