<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Event
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
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('events.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded">
                + Tambah Event
            </a>
        @endif

        <div class="mt-6">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">Nama</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Lokasi</th>
                        <th class="p-2">Harga</th>
                        <th class="p-2">Kuota</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr class="border-t">
                            <td class="p-2">{{ $event->nama_event }}</td>
                            <td class="p-2">{{ $event->tanggal }}</td>
                            <td class="p-2">{{ $event->lokasi }}</td>
                            <td class="p-2">Rp {{ number_format($event->harga) }}</td>
                            <td class="p-2">{{ $event->kuota }}</td>

                            <td class="p-2">
                                @if(auth()->user()->role !== 'admin')
                                    <form action="{{ route('transactions.store') }}" method="POST" class="flex gap-2">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="number" name="jumlah_tiket" min="1"
                                               class="border p-1 w-20" placeholder="Jumlah" required>
                                        <button class="bg-green-500 text-white px-2 py-1 rounded">
                                            Beli
                                        </button>
                                    </form>
                                @else
                                    -
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center">
                                Belum ada event
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>