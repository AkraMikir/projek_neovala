@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="display-4 mb-4" style="color: var(--lego-red);">Selamat Datang di Kasir Akram</h1>
                <p class="lead">Sistem Kasir Modern dengan Tampilan Tampilan yang dapat di sesuaikan</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100" style="background-color: var(--lego-red); color: var(--lego-white);">
            <div class="card-body text-center">
                <h3 class="card-title mb-4">Total Produk</h3>
                <p class="display-4 mb-0">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100" style="background-color: var(--lego-yellow); color: var(--lego-black);">
            <div class="card-body text-center">
                <h3 class="card-title mb-4">Total Pelanggan</h3>
                <p class="display-4 mb-0">{{ $totalCustomers }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100" style="background-color: var(--lego-black); color: var(--lego-white);">
            <div class="card-body text-center">
                <h3 class="card-title mb-4">Total Penjualan</h3>
                <p class="display-4 mb-0">{{ $totalSales }}</p>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="mb-0" style="color: var(--lego-red);">Penjualan Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSales as $sale)
                            <tr>
                                <td>{{ $sale->invoice_number }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ formatRupiah($sale->total_amount) }}</td>
                                <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 