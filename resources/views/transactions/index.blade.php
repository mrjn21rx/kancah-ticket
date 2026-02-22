<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Daftar Transaksi
        </h2>
    </x-slot>

    <div class="py-6 px-6">

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">User</th>
                    <th class="p-2">Event</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr class="border-t">
                    <td class="p-2">{{ $t->user->name }}</td>
                    <td class="p-2">{{ $t->event->nama_event }}</td>
                    <td class="p-2">{{ $t->jumlah_tiket }}</td>
                    <td class="p-2">Rp {{ number_format($t->total_harga) }}</td>
                    <td class="p-2">{{ $t->status }}</td>
                    <td class="p-2">
                        @if($t->status === 'pending')
                            <a href="{{ route('transactions.verify', $t->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded">
                               Verifikasi
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
