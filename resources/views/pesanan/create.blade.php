<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('pesanan.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="idmeja" value="Meja" />
                        <select id="idmeja" name="idmeja" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Meja --</option>
                            @foreach ($meja as $item)
                                <option value="{{ $item->idmeja }}" {{ old('idmeja') == $item->idmeja ? 'selected' : '' }}>
                                    {{ $item->nomor_meja }} ({{ ucfirst($item->status) }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('idmeja')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <x-input-label for="idpelanggan" value="Pelanggan" />
                            <a href="{{ route('pelanggan.create') }}" class="text-xs text-indigo-600 hover:underline">
                                + Pelanggan baru
                            </a>
                        </div>
                        <select id="idpelanggan" name="idpelanggan" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggan as $item)
                                <option value="{{ $item->idpelanggan }}" {{ old('idpelanggan') == $item->idpelanggan ? 'selected' : '' }}>
                                    {{ $item->namapelanggan }} ({{ $item->nohp }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('idpelanggan')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="idmenu" value="Menu" />
                        <select id="idmenu" name="idmenu" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Menu --</option>
                            @foreach ($menu as $item)
                                <option value="{{ $item->idmenu }}" {{ old('idmenu') == $item->idmenu ? 'selected' : '' }}>
                                    {{ $item->namamenu }} — Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('idmenu')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('pesanan.index') }}"
                            class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                            Kembali
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Pesanan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>