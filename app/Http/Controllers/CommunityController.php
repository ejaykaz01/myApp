<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $announcements = DB::table('community_posts')
            ->latest()
            ->get();

        return view('community.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        DB::table('community_posts')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'type' => 'update',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back();
    }
}