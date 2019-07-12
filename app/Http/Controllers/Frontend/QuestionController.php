<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Comment;
use App\Models\Review;
use App\Models\Quetsion;
use Auth;
use Validator;
use Hash;
use Session;

class QuestionController extends Controller
{
    //get question
    public function index()
    {
        return;
    }

    //get question/create
    public function create()
    {
        return;
    }

    //post question
    public function store()
    {
        return;
    }

    //get question/{hotels}
    public function show($id)
    {
        return;
    }

    //question/{question}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch question/{question}
    public function update($id, Request $req)
    {
        return ;
    }

    //delete question/{question}
    public function destroy($id)
    {
        return;
    }
}
