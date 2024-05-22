<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Note;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function __construct()
    {
    }

    public function incrementMethodModel()
    {
        $note = Note::find(1);
        $note->increment('reads');
    }

    public function findOrFail()
    {
        return Note::findOrFail(12);
    }

    public function firstOrCreate()
    {
        $note =  Note::firstOrNew(['note' => 'sdwes']);
        //$note->user_id  = 1;
        $note->save();
    }


    public function relationshipWithConditions()
    {
        $messages =  Message::find(3);

        return [$messages->availableCredits(), $messages];
    }

    public function modeCustom()
    {
        return Note::withMoreReads(2);
    }

    public function whereX()
    {
        return [
                 Note::whereDate('created_at', '2024-05-07')->take(1)->get(),
                 Note::whereDay('created_at', '8')->take(1)->get(),
                 Note::whereMonth('created_at', '6')->take(1)->get(),
                 Note::whereYear('created_at', '2024')->take(1)->get(),
            ];
    }

    public function when()
    {
        $user_id = 2;
        return Message::query()
            ->when($user_id, function ($query)  use($user_id){
                return $query->where('user_id', '=', $user_id);
            })
            ->count();
    }

    public function withDefault()
    {
        return Message::with('user')->get();
    }
}
