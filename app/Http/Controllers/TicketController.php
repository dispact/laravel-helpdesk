<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\Building;
use App\Models\Category;
use App\Models\StaffTicket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        return view('tickets.index', [
            'tickets' => Ticket::latest('updated_at')
                ->filter(request(['search', 'category', 'status', 'staff']))
                ->with('category', 'building', 'status', 'author', 'staff')
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function show(Ticket $ticket) {
        return view('tickets.show', [
            'ticket' => $ticket
        ]);
    }

    public function update(Request $request) {
        try {
            $request->validate([
                'status' => 'required',
                'category' => 'required', 
                'building' => 'required',
                'ticket_id' => 'required'
            ]);

            $ticket = Ticket::find($request->ticket_id);

            $ticket->status_id = $request->status;
            $ticket->category_id = $request->category;
            $ticket->building_id = $request->building;

            $ticket->save();

            return response()->json(['msg' => 'Ticket updated!'], 200);
            
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error updating ticket...'], 400);
        }
    }

    public function updateStaff(Request $request) { 
        try {
            $request->validate([
                'staff' => 'required',
                'ticket_id' => 'required'
            ]);

            StaffTicket::where('ticket_id', $request->ticket_id)->delete();

            $ticket = Ticket::find($request->ticket_id);

            $ticket->staff()->attach($request->staff);
            
            return response()->json(['msg' => 'Staff updated!'], 200);
        } catch (\exception $e) {
            dd($e);
            return response()->json(['msg' => 'Error updating staff...'], 400);
        }
    }
}
