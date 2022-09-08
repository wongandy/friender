<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('friends.index', [
            'friends' => auth()->user()->friends,
            'friendsFrom' => auth()->user()->pendingFriendsFrom,
            'friendsTo' => auth()->user()->pendingFriendsTo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        if ($request->user()->ownsProfile($user) || $request->user()->hasPendingFriendRequestTo($user)) {
            abort(404);
        }

        $request->user()->friendsTo()->attach($user);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $request->user()->friendsFrom()->updateExistingPivot($user, [
            'accepted' => 1
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        if ($request->user()->friendsFrom()->detach($user)) {
            return back();
        }

        $request->user()->friendsTo()->detach($user);

        return back();
    }
}
