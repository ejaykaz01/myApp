<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.items');
    }

    public function data(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $query = DB::table('items')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->select(
                'items.id',
                'items.title',
                'items.type',
                'items.status',
                'items.is_solved',
                'items.created_at',
                'users.name as user_name'
            )
            ->orderBy('items.created_at', 'desc');

      
        if ($request->status && $request->status !== 'all') {

            if ($request->status === 'solved') {
                $query->where('items.is_solved', 1);
            } else {
                $query->where('items.status', $request->status)
                      ->where('items.is_solved', 0);
            }
        }

        $items = $query->get();

        return response()->json(['data' => $items]);
    }

    public function approve($id)
    {
        DB::table('items')->where('id', $id)->update([
            'status' => 'approved',
            'is_solved' => 0
        ]);

        return response()->json(['success' => true]);
    }

    public function reject($id)
    {
        DB::table('items')->where('id', $id)->update([
            'status' => 'rejected',
            'is_solved' => 0
        ]);

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        DB::table('items')->where('id', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function solve($id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $updated = DB::table('items')
        ->where('id', $id)
        ->update([
            'status' => 'solved'
        ]);

    return response()->json([
        'success' => true,
        'updated' => $updated
    ]);
}

public function students()
{
    $students = DB::table('users')
        ->select('id','name','email','role','created_at')
        ->orderBy('created_at','desc')
        ->get();

    return view('admin.students', compact('students'));
}

public function updateClaim(Request $request, $id)
{
    DB::table('claims')
        ->where('id', $id)
        ->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

    return response()->json(['success' => true]);
}

public function claims()
{
    $claims = DB::table('claims')
        ->join('users', 'claims.user_id', '=', 'users.id')
        ->join('items', 'claims.item_id', '=', 'items.id')
        ->select(
            'claims.*',
            'users.name as user_name',
            'items.title as item_title',
            'items.type'
        )
        ->orderBy('claims.created_at', 'desc')
        ->get();

    return view('admin.claims', compact('claims'));
}

public function storeCommunity(Request $request)
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