@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0" style="color: var(--lego-red);">Detail Penjualan</h2>
            <div>
                <a href="{{ route('sales.index') }}" class="btn btn-primary me-2" style="background-color: var(--lego-black); border-color: var(--lego-black);">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary" style="background-color: var(--lego-black); border-color: var(--lego-black);">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="mb-4" style="color: var(--lego-red);">
                    <i class="fas fa-info-circle me-2"></i>Informasi Transaksi
                </h4>
                <table class="table">
                    <tr>
                        <th style="width: 150px;">
                            <i class="fas fa-receipt me-2 text-muted"></i>No. Invoice
                        </th>
                        <td class="fw-bold">{{ $sale->invoice_number }}</td>
                    </tr>
                    <tr>
                        <th>
                            <i class="fas fa-calendar me-2 text-muted"></i>Tanggal
                        </th>
                        <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>
                            <i class="fas fa-user me-2 text-muted"></i>Pelanggan
                        </th>
                        <td>{{ $sale->customer->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="mb-4" style="color: var(--lego-red);">
                    <i class="fas fa-money-bill-wave me-2"></i>Informasi Pembayaran
                </h4>
                <table class="table">
                    <tr>
                        <th style="width: 150px;">
                            <i class="fas fa-shopping-cart me-2 text-muted"></i>Total
                        </th>
                        <td class="fw-bold text-end">{{ \App\Helpers\FormatHelper::formatRupiah($sale->total_amount) }}</td>
                    </tr>
                    <tr>
                        <th>
                            <i class="fas fa-hand-holding-usd me-2 text-muted"></i>Bayar
                        </th>
                        <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($sale->paid_amount) }}</td>
                    </tr>
                    <tr>
                        <th>
                            <i class="fas fa-money-bill-alt me-2 text-muted"></i>Kembalian
                        </th>
                        <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($sale->change_amount) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-4" style="color: var(--lego-red);">
            <i class="fas fa-box me-2"></i>Detail Produk
        </h4>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px">No</th>
                        <th>Produk</th>
                        <th class="text-end">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->details as $detail)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $detail->product->name }}</td>
                            <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($detail->price) }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $detail->quantity }}</span>
                            </td>
                            <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($detail->subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total:</th>
                        <th class="text-end" style="font-size: 1.2em; color: var(--lego-red);">
                            {{ \App\Helpers\FormatHelper::formatRupiah($sale->total_amount) }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('sales.print', $sale->id) }}" target="_blank" class="btn btn-primary" style="background-color: var(--lego-black); border-color: var(--lego-black);">
        <i class="fas fa-print me-2"></i>Cetak Struk
    </a>
</div>

<!-- Tambahkan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection 