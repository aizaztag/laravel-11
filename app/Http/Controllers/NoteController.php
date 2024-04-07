<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Using dependency injection to get the authenticated user
        $user = auth()->user();
        // Retrieving notes associated with the authenticated user
        $notes = $user->notes()
            ->latest() // You can use latest() instead of orderBy('created_at', 'desc')
            ->paginate();
        return view('note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
                                       'note' => ['required', 'string']
                                   ]);

        // Associate the note with the authenticated user
        $data['user_id'] = $request->user()->id;

        // Create the note
        $note = Note::create($data);

        // Redirect to the show route for the created note with a success message
        return Redirect::route('note.show', $note)->with('message', 'Note was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }

        return view('note.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('note.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $data = $request->validate(
            [
                'note' => ['required', 'string']
            ]
        );

        $note->update($data);

        return Redirect::route('note.show', $note)->with(
            //custom macro defined in AppServiceProvider boot method
            response()->flash('tahnks', 'success')
        );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $note->delete();

        return to_route('note.index')->with('message', 'Note was deleted');
    }
}
