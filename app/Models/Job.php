<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'item_rewards' => 'collection',
        'recommended_skills' => 'collection'
    ];

    public $userStats;

    public function getUserStats(User $user)
    {
        if (!$this->userStats) {
            return $this->userStats = $user->user_jobs()->where('job_id', $this->id)->first();
        }

        return $this->userStats;
    }

    public function getUserNext(User $user)
    {
        $userStats = $this->getUserStats($user);

        if (!$userStats) return -1;

        $nextJob = $userStats->updated_at->addSeconds($this->seconds_between_each_job);
        return now()->diffInSeconds($nextJob, false);
    }



    public function getItemRewardsDataAttribute()
    {
        $items = collect();

        foreach($this->item_rewards as $itemId) {
            $items->add(Item::find($itemId));
        }
        return $items;

    }

}
