<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{

    public function index(Request $request, $customerId)
    {
        return Note::where('customer_id', $customerId)->get();
    }

    public function show($id)
    {
        return Note::find($id) ?? response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $request, $customerId)
    {
        // dd($request->all());
        $note = new Note();
        $note->note = $request->get('note');
        $note->customer_id = $customerId; // استخدم قيمة الـ route بدل الـ request
        $note->save();

        return $note;
    }

    public function update(Request $request, $customerId, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        $customerId = (int)$customerId;
        
        if ($note->customer_id !== $customerId) {
            return response()->json(['status' => 'invalid'], Response::HTTP_NOT_FOUND);
        }

        $note->note = $request->get('note');
        $note->save();

        return $note;
    }

    public function delete(Request $request, $customerId, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['status' => 'invalid'], Response::HTTP_NOT_FOUND);
        }

        $note->delete();

        return response()->json(['status' => 'Deleted'], Response::HTTP_OK);
    }
}
