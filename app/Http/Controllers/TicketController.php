<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Unit;
use App\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $statuses = TicketStatus::all();
            if ($user_id === 1) {
                //Admin
                $tickets = Ticket::all();
            } else {
                // User
                $tickets = Ticket::where('user_id', $user_id)->get();
            }
            return view('tickets.index')
                ->with('tickets', $tickets)
                ->with('statuses', $statuses);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->all();
        if (Auth::check()) {
            $ticket_code = strtoupper(Str::random(10));
            $request->request->add(['ticket_code' => $ticket_code]);
            $validatedData = $request->validate([
                'ticket_code' => 'required|string|unique:tickets,ticket_code',
                'date_needed' => 'required|date_format:Y-m-d',
                'date_returned' => 'required|date_format:Y-m-d|after_or_equal:date_needed'
            ]);
            $ticket = new Ticket($validatedData);
            $ticket->user_id = Auth::user()->id;


            $ticket->save();

            // checks if session is not null
            if (!(is_null(session('cart')))) {
                $unitKeys = array_keys(session('cart'));
                $units = Unit::find($unitKeys);

                //check if there is a unit recently deleted in request form 
                if ($request->countUnits != count($units)) {
                    $ticket->delete();
                    // removes all units from cart
                    session()->forget('cart');

                    // adds the remaining units that was not deleted to session
                    foreach ($units as $unit) {
                        $request->session()->put("cart.$unit->id");
                    }

                    return redirect(route('cart.index'))
                        ->with('units', $units)
                        ->with('message', "Submit request failed. At least one unit in your request form  was recently deleted. Please submit again if you are willing to continue.")->with('alert', 'danger');
                }

                $isAllAvailable = true;

                // checks if all unit is available
                foreach ($units as $unit) {
                    if ($unit->status_id !== 1) {
                        $isAllAvailable = false;
                        break;
                    }
                    $ticket->units()->attach($unit->id);
                }

                // condition if all units are available
                if ($isAllAvailable) {
                    // submits the request
                    $ticket->save();
                    session()->forget('cart');
                    return redirect(route('tickets.show', $ticket->id))->with('message', "New ticket ({$ticket->ticket_code}) was added successfully.")->with('alert', 'success');
                } else {
                    $ticket->units()->detach();
                    $ticket->delete();

                    $units = Unit::find(array_keys(session('cart')));
                    return redirect(route('cart.index'))
                        ->with('units', $units)
                        ->with('message', "Submit request failed. Please remove all not available units.")->with('alert', 'danger');
                }
            } else {
                $ticket->delete();
                session()->forget('cart');
                return redirect(route('cart.index'))
                    ->with('message', "Submit request failed. The unit you have added to the cart has been already deleted.")->with('alert', 'danger');
            }
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
         $user_id = Auth::id();
        $statuses = TicketStatus::all();
        // user can only view his/her own ticket and admin.
        if ($user_id === $ticket->user_id || $user_id === 1) {
            return view('tickets.show')
                ->with('ticket', $ticket)
                ->with('statuses', $statuses);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $ticket->status_id = $request->status_id;
        $ticket->save();

        return back()->with('message', "Ticket's ({$ticket->ticket_code}) status was edited successfully.")->with('alert', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
         $this->authorize('delete', $ticket);
        $ticket->units()->detach();
        $ticket->delete();
        return redirect(route('tickets.index'))->with('message', "Ticket {$ticket->ticket_code} was deleted successfully.")->with('alert', 'warning');
    }
}
