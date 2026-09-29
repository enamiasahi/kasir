<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$menu->exists ? 'Edit Menu' : 'Tambah Menu'}}
        </h2>
    </x-slot>

        <div class="py-8">
            <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                    <form method="POST"
                        action="{{ $menu->exists ? route('menu.update', $menu) : route('menu.store') }}">
                        @csrf
                        @if ($menu->exists) @method('PUT') @endif

                        <div class="mb-4">
                            <x-input-label for="namamenu" value="Nama Menu" />
                            <x-text-input id="namamenu" name="namamenu" type="text" class="mt-1 block w-full"
                                value="{{ old('namamenu', $menu->namamenu) }}" required autofocus />
                            <x-input-error :messages="$errors->get('namamenu')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="harga" value="Harga" />
                            <x-text-input id="harga" name="harga" type="number" min="0" step="1000"
                                class="mt-1 block w-full"
                                value="{{ old('harga', $menu->harga ?? 0) }}" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="kategori" value="Kategori" />
                            <select id="kategori" name="kategori"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                @foreach (['makanan', 'minuman'] as $kategori)
                                    <option value="{{ $kategori }}"
                                        {{ old('kategori', $menu->kategori) === $kategori ? 'selected' : '' }}>
                                        {{ ucfirst($kategori) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>{{ $menu->exists ? 'Simpan Perubahan' : 'Tambah Menu' }}</x-primary-button>
                            <a href="{{ route('menu.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>