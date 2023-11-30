<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function showNotes(Request $request)
    {
        $user = auth()->user();

        $search = $request->input('search');

        $notes = Notes::where('user_id', $user->id)->latest('id');

        if ($search) {
            $notes->where(function ($query) use ($search) {
                $query->where('text', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%');
            });
        }

        $notes = $notes->paginate(10);

        return view('user.notes', compact('notes', 'search'));
    }

    public function deleteNotes($id)
    {
        $note = Notes::findOrFail($id);
        $note->delete();

        return redirect()->route('notes.show')->with('success', 'Notatka została usunięta.');
    }

    public function showAddNoteView()
    {
        return view('user.addNote');
    }

    public function addNote(Request $request)
    {
        $request->validate([
            'title' => 'max:200',
            'text' => 'nullable|max:5000',
        ]);

        $user = auth()->user();

        $title = $request->input('title') ?: 'Bez tytułu';

        $note = new Notes([
            'user_id' => $user->id,
            'title' => $title,
            'text' => $request->input('text'),
        ]);

        $note->save();

        return redirect()->route('notes.show')->with('success', 'Notatka została dodana.');
    }

    public function editNote($id)
    {
        $note = Notes::findOrFail($id);

        return view('user.editNote', compact('note'));
    }

    public function updateNote(Request $request, $id)
    {
        $note = Notes::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'max:200',
            'text' => 'nullable|max:5000',
        ]);

        $note->title = $validatedData['title'] ?: 'Bez tytułu';

        if ($request->has('text')) {
            $note->text = $validatedData['text'];
        }

        $note->save();

        return redirect()->route('notes.show')->with('success', 'Notatka została zapisana.');
    }

}
