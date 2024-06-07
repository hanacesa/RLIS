<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supervisors = Supervisor::paginate(10);
        // Pass the $volunteers variable to the view
        return view('supervisor.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supervisor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:supervisors|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($request) {
            // Create a supervisor
            $supervisor = Supervisor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash the password
            ]);

            // Create a user for the supervisor
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin', // or any role you prefer
                'supervisor_id' => $supervisor->id,
            ]);
        });

        return redirect()->route('supervisor.index')->with('success', 'Supervisor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisor $supervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supervisor $supervisor)
    {
        return view('supervisor.edit', compact('supervisor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:supervisors,email,' . $supervisor->id . '|unique:users,email,' . $supervisor->user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($request, $supervisor) {
            // Update supervisor fields
            $supervisor->update($request->only(['name', 'email']));

            // Check if the supervisor has a related user
            if ($supervisor->user) {
                $user = $supervisor->user;

                // Update user fields
                $userData = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'supervisor_id' => $supervisor->id,
                ];

                // Update password if provided and not empty
                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->input('password'));
                }

                // Update the user with the new data
                $user->update($userData);
            } else {
                // Create a user for the supervisor
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'admin',
                    'supervisor_id' => $supervisor->id,
                ]);
            }
        });

        return redirect()->route('supervisor.index')->with('success', 'Supervisor record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervisor $supervisor)
    {
        $supervisor->delete();
        return redirect()->route('supervisor.index')->with('success', 'Supervisor record deleted successfully.');
    }
}
