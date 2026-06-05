<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
 
class Event extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'title', 'slug', 'type', 'icon', 'description', 'location',
        'event_date', 'start_time', 'end_time', 'max_participants',
        'registered_participants', 'status', 'is_published',
    ];
 
    protected $casts = [
        'is_published' => 'boolean',
        'event_date' => 'date',
    ];
 
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
 
    public function getSlotPercentageAttribute(): int
    {
        if ($this->max_participants == 0) return 0;
        return round(($this->registered_participants / $this->max_participants) * 100);
    }
}
 