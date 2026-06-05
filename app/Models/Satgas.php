<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Satgas extends Model
{
    use HasFactory;
 
    protected $table = 'satgas';
 
    protected $fillable = [
        'name', 'role', 'unit', 'badge', 'avatar_initials',
        'joined_year', 'certifications', 'phone', 'email', 'is_active',
    ];
 
    protected $casts = [
        'certifications' => 'array',
        'is_active' => 'boolean',
    ];
}
 