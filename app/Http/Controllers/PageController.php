<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function postIndex()
    {
        return Inertia::render('Post/Index',['posts' => Post::with(['user', 'comments'])->get()]);
    }

    public function postCreate()
    {
        return Inertia::render('Post/Create');
    }

}
