<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Event
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Nama Event</label>
                <input type="text" name="nama_event" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="border w-full p-2"></textarea>
            </div>

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Harga</label>
                <input type="number" name="harga" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Kuota</label>
                <input type="number" name="kuota" class="border w-full p-2">
            </div>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>