<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_category_id',
        'title',
        'category',
        'privacy',
        'file',
        'view',
        'created_at',
        'updated_at',
        'mobile_app_image'
    ];

    /**
     * Get the user that owns the video.
     */
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category that the video belongs to.
     */
    public function videoCategory()
    {
        return $this->belongsTo(VideoCategory::class, 'video_category_id');
    }
    
}
