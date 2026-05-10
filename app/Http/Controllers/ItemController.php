<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;

class ItemController extends Controller
{

    public function index()
    {
        return view('items.index');
    }

    public function search(Request $request)
    {
        $query = DB::table('items')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->select(
                'items.*',
                'users.name as user_name',
                DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.item_id = items.id) as likes_count')
            );

        if ($request->filled('q')) {
            $q = $request->q;

            $query->where(function ($sub) use ($q) {
                $sub->where('items.title', 'like', "%$q%")
                    ->orWhere('items.description', 'like', "%$q%");
            });
        }

        if ($request->filled('type')) {
            $query->where('items.type', $request->type);
        }

        $items = $query->latest()->get();

        return view('search', compact('items'));
    }


    public function data()
    {
        $items = DB::table('items')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->select('items.*', 'users.name as user_name')
            ->get();

        return response()->json(['data' => $items]);
    }


    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
        }

        DB::table('items')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'image' => $imageName,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'is_solved' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $item = DB::table('items')->where('id', $id)->first();
        return response()->json($item);
    }


    public function update(Request $request, $id)
    {
        DB::table('items')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

   
    public function delete($id)
    {
        DB::table('items')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function feed()
    {
        $items = DB::table('items')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->select('items.*', 'users.name as user_name')
            ->where('items.is_solved', 0)
            ->orderBy('items.created_at', 'desc')
            ->get();

        return view('feed', compact('items'));
    }

    public function dashboard(Request $request)
{
    $itemsQuery = DB::table('items')
        ->join('users', 'items.user_id', '=', 'users.id')
        ->leftJoin('claims', function ($join) {
            $join->on('items.id', '=', 'claims.item_id')
                ->where('claims.status', '=', 'approved');
        })
        ->select(
            'items.*',
            'users.id as user_id',
            'users.name as user_name',
            DB::raw('(SELECT COUNT(*) FROM likes WHERE likes.item_id = items.id) as likes_count'),
            DB::raw('claims.status as claim_status')
        )
        ->where('items.status', 'approved');

    if ($request->filled('type')) {
        $itemsQuery->where('items.type', $request->type);
    }

    $items = $itemsQuery
        ->orderBy('items.created_at', 'desc')
        ->get();

    foreach ($items as $item) {
        $item->comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.item_id', $item->id)
            ->select('comments.comment', 'users.name as user_name')
            ->get();
    }

    $recentActivities = DB::table('items')->latest()->take(3)->get();

    $topReporters = DB::table('users')
    ->leftJoin('items', 'users.id', '=', 'items.user_id')
    ->select(
        'users.id',
        'users.name',
        'users.email',
        DB::raw('COUNT(items.id) as items_count')
    )
    ->groupBy('users.id', 'users.name', 'users.email')
    ->orderByDesc('items_count')
    ->take(3)
    ->get();

    return view('dashboard', compact('items', 'recentActivities', 'topReporters'));
}

 
    public function like($id)
    {
        $userId = Auth::id();

        $like = DB::table('likes')
            ->where('item_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            DB::table('likes')->where('id', $like->id)->delete();
        } else {
            DB::table('likes')->insert([
                'item_id' => $id,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $count = DB::table('likes')->where('item_id', $id)->count();

        return response()->json(['likes' => $count]);
    }

    public function comment(Request $request, $id)
    {
        $commentId = DB::table('comments')->insertGetId([
            'item_id' => $id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $comment = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->where('comments.id', $commentId)
            ->first();

        return response()->json([
            'user' => $comment->name,
            'comment' => $comment->comment
        ]);
    }


    public function claimItem(Request $request, $id)
    {
        $existing = DB::table('claims')
            ->where('item_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'You already claimed this item'
            ]);
        }

        DB::table('claims')->insert([
            'item_id' => $id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'message' => 'Claim submitted successfully'
        ]);
    }

   public function userProfile($id)
{
   $user = DB::table('users')->where('id', $id)->first();

if (!$user) {
    abort(404);
}

    $posts = DB::table('items')
    ->leftJoin('likes', 'items.id', '=', 'likes.item_id')
    ->where('items.user_id', $id)
    ->select(
        'items.id',
        'items.title',
        'items.description',
        'items.type',
        'items.image',
        'items.created_at',
        DB::raw('COUNT(likes.id) as likes_count')
    )
    ->groupBy(
        'items.id',
        'items.title',
        'items.description',
        'items.type',
        'items.image',
        'items.created_at'
    )
    ->orderByDesc('items.created_at')
    ->get();

    return view('user.profile', compact('user', 'posts'));
}
}