<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NoteApiController extends Controller
{
    //


    public function index()
    {
        //custom macro
        return Response::api(Note::all());
    }
}
