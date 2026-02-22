<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
        'nama_event' => 'required',
        'tanggal' => 'required',
        'lokasi' => 'required',
        'harga' => 'required|numeric',
        'kuota' => 'required|numeric',
    ]);

    Event::create($request->all());

    return redirect()->route('events.index')
                     ->with('success', 'Event berhasil ditambahkan');
    }

    public function dashboard()
    {
    $totalEvent = \App\Models\Event::count();
    $totalTransaksi = \App\Models\Transaction::count();
    $totalTiketTerjual = \App\Models\Transaction::where('status', 'verified')
        ->sum('jumlah_tiket');

    return view('admin.dashboard', compact(
        'totalEvent',
        'totalTransaksi',
        'totalTiketTerjual'
    ));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
