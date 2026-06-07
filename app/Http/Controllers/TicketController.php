<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Notification;
use App\Models\ActivityLog;
use App\Models\User;

use App\Events\NotificationSent;
use App\Events\TicketCreated;

class TicketController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Ticket::with('user');

        if (auth()->user()->role !== 'admin') {

            $query->where('user_id', auth()->id());

        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('category', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($user) use ($request) {

                        $user->where('name', 'like', '%' . $request->search . '%');

                    });

            });

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->status) {

            $query->where('status', $request->status);

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER PRIORITY
        |--------------------------------------------------------------------------
        */

        if ($request->priority) {

            $query->where('priority', $request->priority);

        }

        $tickets = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tickets.index', compact('tickets'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('tickets.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',

            'description' => 'required',

            'category' => 'required',

            'priority' => 'required',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('tickets', 'public');

        }

        $ticket = Ticket::create([

            'user_id' => auth()->id(),

            'title' => $request->title,

            'description' => $request->description,

            'category' => $request->category,

            'priority' => $request->priority,

            'status' => 'Pending',

            'image' => $imagePath,

        ]);

        /*
        |--------------------------------------------------------------------------
        | LOAD USER
        |--------------------------------------------------------------------------
        */

        $ticket->load('user');

        /*
        |--------------------------------------------------------------------------
        | REALTIME TABLE ADMIN
        |--------------------------------------------------------------------------
        */

        event(new TicketCreated($ticket));

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATION ADMIN REALTIME
        |--------------------------------------------------------------------------
        */

        $message =
            auth()->user()->name .
            ' membuat ticket baru: "' .
            $ticket->title . '"';

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {

            Notification::create([

                'user_id' => $admin->id,

                'message' => $message

            ]);

            /*
            |--------------------------------------------------------------------------
            | REALTIME EVENT ADMIN
            |--------------------------------------------------------------------------
            */

            event(new NotificationSent(
                $message,
                $admin->id
            ));

        }

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */

        ActivityLog::create([

            'user_id' => auth()->id(),

            'action' => 'Create Ticket',

            'description' =>
                auth()->user()->name .
                ' membuat ticket: ' .
                $ticket->title

        ]);

        return redirect() 
            ->route('tickets.index') 
            ->with('success_toast', 'Ticket created successfully 🎉');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Ticket $ticket)
    {
        if (
            auth()->user()->role !== 'admin' &&
            $ticket->user_id !== auth()->id()
        ) {

            abort(403);

        }

        if (
            auth()->user()->role !== 'admin' &&
            $ticket->status !== 'Pending'
        ) {

            return redirect()
                ->route('tickets.index')
                ->with(
                    'error',
                    'Ticket tidak bisa diedit karena sedang diproses.'
                );

        }

        return view('tickets.edit', compact('ticket'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([

            'title' => 'required',

            'description' => 'required',

            'category' => 'required',

            'priority' => 'required',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $imagePath = $ticket->image;

        if ($request->hasFile('image')) {

            if (
                $ticket->image &&
                file_exists(public_path('storage/' . $ticket->image))
            ) {

                unlink(public_path('storage/' . $ticket->image));

            }

            $imagePath = $request->file('image')
                ->store('tickets', 'public');

        }

        $ticket->update([

            'title' => $request->title,

            'description' => $request->description,

            'category' => $request->category,

            'priority' => $request->priority,

            'image' => $imagePath

        ]);

        ActivityLog::create([

            'user_id' => auth()->id(),

            'action' => 'Update Ticket',

            'description' =>
                auth()->user()->name .
                ' mengupdate ticket: ' .
                $ticket->title

        ]);

        return redirect() 
            ->route('tickets.index') 
            ->with('success_toast', 'Ticket updated successfully ✨');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Ticket $ticket)
    {
        ActivityLog::create([

            'user_id' => auth()->id(),

            'action' => 'Delete Ticket',

            'description' =>
                auth()->user()->name .
                ' menghapus ticket: ' .
                $ticket->title

        ]);

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS
    |--------------------------------------------------------------------------
    */

    public function process($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->status = 'Process';

        $ticket->save();

        $message =
            'Ticket "' .
            $ticket->title .
            '" sedang diproses admin.';

        Notification::create([

            'user_id' => $ticket->user_id,

            'message' => $message

        ]);

        /*
        |--------------------------------------------------------------------------
        | REALTIME USER
        |--------------------------------------------------------------------------
        */

        event(new NotificationSent(
            $message,
            $ticket->user_id
        ));

        ActivityLog::create([

            'user_id' => auth()->id(),

            'action' => 'Process Ticket',

            'description' =>
                auth()->user()->name .
                ' memproses ticket: ' .
                $ticket->title

        ]);

        return back()
            ->with('success', 'Ticket sedang diproses');
    }

    /*
    |--------------------------------------------------------------------------
    | DONE
    |--------------------------------------------------------------------------
    */

    public function done($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->status = 'Done';

        $ticket->save();

        $message =
            'Ticket "' .
            $ticket->title .
            '" telah selesai.';

        Notification::create([

            'user_id' => $ticket->user_id,

            'message' => $message

        ]);

        /*
        |--------------------------------------------------------------------------
        | REALTIME USER
        |--------------------------------------------------------------------------
        */

        event(new NotificationSent(
            $message,
            $ticket->user_id
        ));

        ActivityLog::create([

            'user_id' => auth()->id(),

            'action' => 'Done Ticket',

            'description' =>
                auth()->user()->name .
                ' menyelesaikan ticket: ' .
                $ticket->title

        ]);

        return back()
            ->with('success', 'Ticket selesai');
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    public function exportPdf()
    {
        $tickets = Ticket::with('user')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('tickets.pdf', compact('tickets'));

        return $pdf->download('ticket-report.pdf');
    }
}