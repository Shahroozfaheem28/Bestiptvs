<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
     'title',
    'slug',
    'price',
    'sale_price',
    'validity_days',
    'expiry_date', // <-- Add this line
    'description',
    'tags',
    'image',
    'category_id',
    ];

    // Automatically generate slug when creating a new plan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($plan) {
            if (empty($plan->slug)) {
                $plan->slug = Str::slug($plan->title);
            }
        });

        // Optional: Update slug if title changes
        static::updating(function ($plan) {
            if ($plan->isDirty('title')) {
                $plan->slug = Str::slug($plan->title);
            }
        });
    }

    // Relationship with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
     public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
