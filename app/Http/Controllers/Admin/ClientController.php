<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::role('client')->get();
        return view('dashboard.clients.index', compact('clients'));
    }

    public function show($id)
    {
        $client = User::findOrFail($id);
        return view('dashboard.clients.show', compact('client'));
    }

    // Optionally add edit, update, destroy, etc. as needed
} 