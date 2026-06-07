<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', function () {

        return view('profile');

    })->name('profile');

    /*
    |--------------------------------------------------------------------------
    | TICKET CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('tickets', TicketController::class);

    /*
    |--------------------------------------------------------------------------
    | PROCESS TICKET
    |--------------------------------------------------------------------------
    */

    Route::put('/tickets/{id}/process', [TicketController::class, 'process'])
        ->name('tickets.process');

    /*
    |--------------------------------------------------------------------------
    | DONE TICKET
    |--------------------------------------------------------------------------
    */

    Route::put('/tickets/{id}/done', [TicketController::class, 'done'])
        ->name('tickets.done');

    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    Route::get('/tickets-export-pdf', [TicketController::class, 'exportPdf'])
        ->name('tickets.export.pdf');

    /*
    |--------------------------------------------------------------------------
    | MARK NOTIFICATION AS READ
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications/read', function () {

        auth()->user()
            ->notifications()
            ->update([
                'is_read' => true
            ]);

        return response()->json([
            'success' => true
        ]);

    })->name('notifications.read');

    /*
    |--------------------------------------------------------------------------
    | GET LATEST NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

        /*
    |--------------------------------------------------------------------------
    | GET LATEST NOTIFICATIONS
    |--------------------------------------------------------------------------
    */


    Route::get('/notifications/latest', function () {

        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($notification) {

                return [

                    'id' => $notification->id,

                    'message' => $notification->message,

                    'is_read' => $notification->is_read,

                    'time' =>
                        $notification->created_at
                        ->timezone('Asia/Jakarta')
                        ->diffForHumans()
                        . ' • ' .
                        $notification->created_at
                        ->timezone('Asia/Jakarta')
                        ->format('d M Y H:i'),

                ];

            });

        $unread = auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->count();

        return response()->json([

            'notifications' => $notifications,

            'unread' => $unread

        ]);

    })->name('notifications.latest');

    });

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';