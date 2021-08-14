<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\Building;
use App\Models\Category;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    // index --> show user's tickets /requests
    public function index() {
        return view('requests.index', [
            'tickets' => Ticket::latest('updated_at')
                ->filter(request(['status', 'search']))
                ->where('author_id', auth()->user()->id)
                ->with('category', 'building', 'status', 'author', 'staff')
                ->paginate(10)
        ]);
    }
    // show --> show a ticket /requests/{id}

    public function show(Ticket $ticket) {
        return view('requests.show', [
            'ticket' => $ticket
        ]);
    }

    // create --> create ticket page /request
    public function create() {
        return view('requests.create', [
            'categories' => Category::all(),
            'buildings' => Building::all()
        ]);
    }

    // store --> store ticket /request
    public function store(Request $request) {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
            'building' => 'required',
            'category' => 'required'
        ]);

        $status = Status::where('name', 'Open')->first();
        $staff = Staff::where('building_id', $request->building)
            ->where('category_id', $request->category)
            ->pluck('id');

        $ticket = Ticket::create([
            'title' => $request->subject,
            'content' => $request->content,
            'building_id' => $request->building,
            'category_id' => $request->category,
            'status_id' => $status->id,
            'author_id' => auth()->user()->id,
        ]);

        if ($staff->isNotEmpty()) {
            $ticket->staff()->attach($staff->implode(', '));
            $ticket->save();
        } else {
            $ticket->staff()->attach('1');
        }

        Message::create([
            'content' => $request->content,
            'author_id' => auth()->user()->id,
            'ticket_id' => $ticket->id
        ]);

        return redirect()->route('requests.show', $ticket->id);
    }
}
