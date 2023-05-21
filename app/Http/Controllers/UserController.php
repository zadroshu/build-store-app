<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns a listing of the resource.
     *
     * @return json
     */
    function getAdmins()
    {
        return response()->json(User::paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    function create(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'password' => 'required|string|max:191',
        ]);

        return response()->json(User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Hash::make($validated['password']),
        ]));
    }

    function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|int',
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
        ]);
        return response()->json(User::where('id', $validated['id'])
            ->update(['name' => $validated['name'], 'email' => $validated['email']]));
    }
}
