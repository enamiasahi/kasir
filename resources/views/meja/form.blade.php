<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$meja->exists ? 'Edit Meja' : 'Tambah Meja'}}
        </h2>
        </x-slot>

        <div class="py-8">
            <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                    <form method="POST"
                        action="{{ $meja->exists ? route('meja.update', $meja) : route('meja.store') }}">
                        @csrf
                        @if ($meja->exists) @method('PUT') @endif

                        <div class="mb-4">
                            <x-input-label for="nomor_meja" value="Nomor Meja" />
                            <x-text-input id="nomor_meja" name="nomor_meja" type="text" class="mt-1 block w-full"
                                value="{{ old('nomor_meja', $meja->nomor_meja) }}" required autofocus />
                            <x-input-error :messages="$errors->get('nomor_meja')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="kapasitas" value="Kapasitas (jumlah kursi)" />
                            <x-text-input id="kapasitas" name="kapasitas" type="number" min="1" class="mt-1 block w-full"
                                value="{{ old('kapasitas', $meja->kapasitas ?? 4) }}" required />
                            <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>{{ $meja->exists ? 'Simpan Perubahan' : 'Tambah Meja' }}</x-primary-button>
                            <a href="{{ route('meja.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</x-app-layout>