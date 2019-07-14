<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Customer;
use Auth;
use JWTAuth;
use Validator;
use Hash;
use Session;

class CommentController extends Controller
{
    //get comment
    public function index()
    {
        return;
    }

    //get comment/create
    public function create()
    {
        return;
    }

    //post comment
    public function store()
    {
        return;
    }

    //get comment/{comment}
    public function show($id)
    {
        return;
    }

    //comment/{comment}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch comment/{comment}
    public function update($id, Request $req)
    {
        return;
    }

    //delete comment/{comment}
    public function destroy($id)
    {
        return;
    }
}
