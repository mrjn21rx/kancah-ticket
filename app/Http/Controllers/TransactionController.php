<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TransactionController extends Controller
{
    // =========================
    // USER BELI TIKET
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'jumlah_tiket' => 'required|numeric|min:1'
        ]);

        $event = Event::findOrFail($request->event_id);

        if ($request->jumlah_tiket > $event->kuota) {
            return back()->with('error', 'Kuota tidak mencukupi');
        }

        $total = $request->jumlah_tiket * $event->harga;

        $kode = 'KS-2026-' . strtoupper(Str::random(4));

        Transaction::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'kode_booking' => $kode,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $total,
            'status' => 'pending'
        ]);

        return redirect()->route('events.index')
            ->with('success', 'Tiket berhasil dipesan (status pending)');

        
    }
    // =========================
    // USER RIWAYAT TRANSAKSI
    // =========================
    public function myTransactions()
    {
        $transactions = Transaction::with('event')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('transactions.my', compact('transactions'));
    }

    // =========================
    // ADMIN LIHAT TRANSAKSI
    // =========================
    public function index()
    {
        $transactions = Transaction::with(['user', 'event'])
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    // =========================
    // ADMIN VERIFIKASI
    // =========================
    public function verify($id)
    {
        $transaction = Transaction::with('event')->findOrFail($id);

        if ($transaction->status === 'pending') {

            $event = $transaction->event;

            if ($transaction->jumlah_tiket > $event->kuota) {
                return back()->with('error', 'Kuota tidak mencukupi');
            }

            $event->kuota -= $transaction->jumlah_tiket;
            $event->save();

            $transaction->status = 'verified';
            $transaction->save();
        }

        return back()->with('success', 'Transaksi berhasil diverifikasi');
    }
}