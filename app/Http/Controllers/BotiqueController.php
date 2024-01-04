<?php

namespace App\Http\Controllers;

use App\Models\Botique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLog;

class BotiqueController extends Controller
{
    public function index()
    {
        $botiques = Botique::all();
        return view('botiques.index', compact('botiques'));
    }

    public function create()
    {
        return view('botiques.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $botique = Botique::create($request->all());
        $log_entry = Auth::user()->name . " added a botique ". $botique->name . " with the id# ". $botique->id;
        event(new UserLog($log_entry));
        return redirect()->route('botiques.index')->with('success', 'botique created successfully');
    }

    public function show(Botique $botique)
    {
        return view('botiques.show', compact('botique'));
    }

    public function edit(Botique $botique)
    {
        return view('botiques.edit', compact('botique'));
    }

    public function update(Request $request, Botique $botique)
{
    $request->validate([
        'item' => 'required',
        'description' => 'required',
        'brand' => 'required',
        'quantity' => 'required|integer',
        'price' => 'required|integer',
    ]);

    $data = $request->only(['item', 'description', 'brand', 'quantity','price']);
    $botique->update($data);

    $log_entry = Auth::user()->name . " updated a botique " . $botique->item . " with the id# " . $botique->id;
    event(new UserLog($log_entry));

    return redirect()->route('botiques.index')
        ->with('success', 'botique updated successfully');
}


    public function destroy(Botique $botique)
    {
        $botique->delete();
        $log_entry = Auth::user()->name . " deleted an botique ". $botique->name . " with the id# ". $botique->id;
        event(new UserLog($log_entry));

        return redirect()->route('botiques.index')
            ->with('success', 'botique deleted successfully');
    }
}
