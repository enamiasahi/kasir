<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Struk Transaksi') }}
        </h2>
    </x-slot>
    
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Detail Transaksi</h3>
                    <p><strong>ID Transaksi:</strong> {{ $transaksi->idtransaksi }}</p>
                    <p><strong>ID Pesanan:</strong> {{ $transaksi->idpesanan }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($transaksi->total, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </div>
</x-app-layout>