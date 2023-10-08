<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }


    public function perform(Request $request, Job $job)
    {

        $request->validate([
            'crews' => 'required'
        ]);

        // Get Crew
        $user = auth()->user();

        $next = $job->getUserNext($user);

        if ($next >= 0) {
            return redirect()->back()->withErrors('You need to wait before you can perform this job again');
        }

        // TODO: Validate crew have enough health
        $crews = $user->crew_members()->whereIn('id', $request->crews)->where('health', '>', 0)->get();

        $maximumCrew = $job->crew_required;
        if ($crews->count() > $maximumCrew) {
            return redirect()->back()->withErrors('Too many crew members selected');
        }


        $recommendedSkills = $job->recommended_skills;

        $availableSkills = [];

        $totalSkillLevelOfCrew = 0;
        $totalSkillRequirement = 0;

        foreach ($recommendedSkills as $skill)
        {

            $skillName = $skill['skill'];
            $skillValue = (int) $skill['value'];

            if (!isset( $availableSkills[$skillName])) {
                $availableSkills[$skillName] = 0;
            }

            foreach($crews as $crew)
            {
                $availableSkills[$skillName] += $crew->{$skillName};
                $totalSkillLevelOfCrew += $crew->{$skillName};
            }

            $totalSkillRequirement += $skillValue;
        }


        // Calculate Success

        $stats = $job->getUserStats($user);

        if (!$stats) {
            $stats = $user->user_jobs()->create(['job_id' => $job->id]);
        }


        // Add / Update User Job Record
        // Give crew members experience

        $percentage = ($totalSkillRequirement / $totalSkillLevelOfCrew) * 100  + random_int(0,$stats->percentage) ;
        $success = ( $percentage >= 100);
        $stats->percentage += 1;
        $stats->save();

        if ($success) {
            $stats->increment('success');
            foreach ($crews as $crew)
            {
                $crew->experience += 10;
                $crew->save();
            }

            $item = Item::whereIn('id', $job->item_rewards)->get()->random(1)->first();

            $user->user_items()->create([
                'item_id' => $item->id
            ]);

            return redirect()->route('jobs.index')->with('status', 'You completed the job, you found a ' . $item->name);
        }

        $stats->increment('failure');

        foreach ($crews as $crew)
        {
            $crew->health -= 10;
            $crew->experience += 1;

            $crew->save();
        }

        return redirect()->route('jobs.index')->withErrors('You failed the job');

    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {


        $user = auth()->user();
        $next = $job->getUserNext($user);


        if ($next >= 0) {
            return redirect()->back()->withErrors('You need to wait before you can perform this job again');
        }

        $user = auth()->user();
        $crews = $user->crew_members;

        return view('jobs.show', compact('job', 'crews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
