<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * PageView Model
 *
 * Stores analytics data for page views tracked by TrackPageViews middleware.
 */
class PageView extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'url',
        'method',
        'ip',
        'user_agent',
        'user_id',
        'response_time_ms',
        'status_code',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected $casts = [
        'response_time_ms' => 'integer',
        'status_code' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the user that made the page view (if authenticated).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get views for a specific URL.
     */
    public function scopeForUrl($query, string $url)
    {
        return $query->where('url', 'like', '%' . $url . '%');
    }

    /**
     * Scope to get recent views.
     */
    public function scopeRecent($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope to get slow requests.
     */
    public function scopeSlow($query, int $threshold = 1000)
    {
        return $query->where('response_time_ms', '>', $threshold);
    }
}
