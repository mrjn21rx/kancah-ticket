<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6 px-6 grid grid-cols-3 gap-6">

        <div class="bg-blue-500 text-white p-6 rounded">
            <h3>Total Event</h3>
            <p class="text-2xl font-bold">{{ $totalEvent }}</p>
        </div>

        <div class="bg-green-500 text-white p-6 rounded">
            <h3>Total Transaksi</h3>
            <p class="text-2xl font-bold">{{ $totalTransaksi }}</p>
        </div>

        <div class="bg-purple-500 text-white p-6 rounded">
            <h3>Total Tiket Terjual</h3>
            <p class="text-2xl font-bold">{{ $totalTiketTerjual }}</p>
        </div>

    </div>
</x-app-layout>