<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $crewMembers =  $user->crew_members;
        $items = $user->items;

        return view('dashboard', compact('crewMembers', 'items', 'user'));
    }
}
