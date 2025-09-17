<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk - {{ $sale->invoice_number }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            width: 80mm; /* Ukuran kertas struk thermal */
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mb-1 { margin-bottom: 5px; }
        .mb-2 { margin-bottom: 10px; }
        .border-bottom { border-bottom: 1px dashed #000; }
        .font-bold { font-weight: bold; }
        table { width: 100%; }
        table.items td { padding: 3px 0; }
        .header { margin-bottom: 20px; }
        .footer { margin-top: 20px; }
        @media print {
            @page {
                margin: 0;
                size: 80mm auto; /* Ukuran kertas struk thermal */
            }
        }
    </style>
</head>
<body>
    <div class="header text-center">
        <h2 style="margin: 0;">Kasir Akram</h2>
        <p style="margin: 5px 0;">Jl. Contoh No. 123</p>
        <p style="margin: 5px 0;">Telp: 08123456789</p>
    </div>

    <div class="border-bottom mb-2"></div>

    <div class="mb-2">
        <table>
            <tr>
                <td>No. Invoice</td>
                <td>: {{ $sale->invoice_number }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $sale->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: {{ auth()->user()->name ?? 'Admin' }}</td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>: {{ $sale->customer->name ?? 'Umum' }}</td>
            </tr>
        </table>
    </div>

    <div class="border-bottom mb-2"></div>

    <table class="items">
        <tr class="font-bold">
            <td>Item</td>
            <td class="text-right">Qty</td>
            <td class="text-right">Harga</td>
            <td class="text-right">Total</td>
        </tr>
        @foreach($sale->details as $detail)
        <tr>
            <td>{{ $detail->product->name ?? 'Produk tidak tersedia' }}</td>
            <td class="text-right">{{ $detail->quantity }}</td>
            <td class="text-right">{{ \App\Helpers\FormatHelper::formatRupiah($detail->price) }}</td>
            <td class="text-right">{{ \App\Helpers\FormatHelper::formatRupiah($detail->quantity * $detail->price) }}</td>
        </tr>
        @endforeach
    </table>

    <div class="border-bottom mb-2"></div>

    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-right">{{ \App\Helpers\FormatHelper::formatRupiah($sale->total_amount) }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="text-right">{{ \App\Helpers\FormatHelper::formatRupiah($sale->paid_amount) }}</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="text-right">{{ \App\Helpers\FormatHelper::formatRupiah($sale->change_amount) }}</td>
        </tr>
    </table>

    <div class="border-bottom mb-2"></div>

    <div class="footer text-center">
        <p class="mb-1">Terima Kasih Atas Kunjungan Anda</p>
        <p class="mb-1">Barang yang sudah dibeli tidak dapat dikembalikan</p>
        <p>* * * * *</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
            // Tunggu proses print selesai, lalu tutup window
            window.onafterprint = function() {
                window.close();
            }
        }
    </script>
</body>
</html> 