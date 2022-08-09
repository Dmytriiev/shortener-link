<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

class ShortLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'link',
        'limit',
        'expired_date',
        'hits'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['full_link'];

    public function getFullLinkAttribute(): string
    {
        return  config('app.url') . '/link/' . $this->code;
    }

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeAvailability(Builder $query): Builder
    {
        return $query
                ->whereColumn('hits','<=','limit')
                ->orWhere('limit', 0)
                ->where('expired_date', '>=', Carbon::today());
    }
}
