<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
     * Returns the specified resource.
     *
     * @param int $id
     * @return json
     */
    public function show(int $id)
    {
        return response()->json(User::where('id', $id)->get());
    }

    /**
     * Returns the specified resource by email.
     *
     * @param string $email
     * @return json
     */
    public function showByEmail(string $email)
    {
        return response()->json(User::where('email', $email)->get());
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
            'password' => Hash::make($validated['password']),
            'is_root' => false,
        ]));
    }

    /**
     * Save the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return json
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return json
     */
    function delete(int $id) {
        return response()->json(User::find($id)->delete());
    }
}
