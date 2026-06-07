<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        // TOTAL TICKET USER LOGIN
        $totalMyTickets = Ticket::where('user_id', $user->id)->count();

        // RECENT TICKET USER LOGIN
        $recentTickets = Ticket::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMyTickets',
            'recentTickets'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function admin()
    {
        $totalUsers = \App\Models\User::count();

        $totalTickets = \App\Models\Ticket::count();

        $pendingTickets = \App\Models\Ticket::where(
            'status',
            'Pending'
        )->count();

        $processTickets = \App\Models\Ticket::where(
            'status',
            'Process'
        )->count();

        $doneTickets = \App\Models\Ticket::where(
            'status',
            'Done'
        )->count();

        $recentTickets = \App\Models\Ticket::with('user')
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOGS
        |--------------------------------------------------------------------------
        */

        $activityLogs = \App\Models\ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(

            'totalUsers',

            'totalTickets',

            'pendingTickets',

            'processTickets',

            'doneTickets',

            'recentTickets',

            'activityLogs'

        ));
    }

}