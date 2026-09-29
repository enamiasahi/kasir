<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$pelanggan->exists ? 'Edit Pelanggan' : 'Tambah Pelanggan'}}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form method="POST"
                    action="{{ $pelanggan->exists ? route('pelanggan.update', $pelanggan) : route('pelanggan.store') }}">
                    @csrf
                    @if ($pelanggan->exists) @method('PUT') @endif

                    <div class="mb-4">
                        <x-input-label for="namapelanggan" value="Nama Pelanggan" />
                        <x-text-input id="namapelanggan" name="namapelanggan" type="text" class="mt-1 block w-full"
                            value="{{ old('namapelanggan', $pelanggan->namapelanggan) }}" required autofocus />
                        <x-input-error :messages="$errors->get('namapelanggan')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="is_man" value="Jenis Kelamin" />
                        <select id="is_man" name="is_man"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="1" {{ old('is_man', $pelanggan->is_man) == 1 ? 'selected' : '' }}>Laki-laki</option>
                            <option value="0" {{ old('is_man', $pelanggan->is_man) == 0 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('is_man')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nohp" value="No. HP" />
                        <x-text-input id="nohp" name="nohp" type="text" class="mt-1 block w-full"
                            value="{{ old('nohp', $pelanggan->nohp) }}" required />
                        <x-input-error :messages="$errors->get('nohp')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" rows="3"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:ring-opacity-50">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('pelanggan.index') }}"
                            class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                            Kembali
                        </a>
                        <x-primary-button>
                            {{ $pelanggan->exists ? 'Update' : 'Simpan' }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>