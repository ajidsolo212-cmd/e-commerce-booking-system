<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudioSession;
use Illuminate\Http\Request;

class AdminSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $sessions = StudioSession::latest()->get();
        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('admin.sessions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'duration'    => 'required|string|max:50',
            'price'       => 'required|numeric|min:0',
            'max_slots'   => 'required|integer|min:1',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        StudioSession::create($data);
        return redirect()->route('admin.sessions.index')->with('success', 'Session created successfully.');
    }

    public function edit(StudioSession $session)
    {
        return view('admin.sessions.edit', compact('session'));
    }

    public function update(Request $request, StudioSession $session)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'duration'    => 'required|string|max:50',
            'price'       => 'required|numeric|min:0',
            'max_slots'   => 'required|integer|min:1',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $session->update($data);
        return redirect()->route('admin.sessions.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(StudioSession $session)
    {
        $session->delete();
        return redirect()->route('admin.sessions.index')->with('success', 'Session deleted.');
    }
}