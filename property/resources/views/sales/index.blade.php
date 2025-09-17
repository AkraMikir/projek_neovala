@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0" style="color: var(--lego-red);">Daftar Penjualan</h2>
            <a href="{{ route('sales.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Tambah Penjualan
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px">No</th>
                        <th>No. Invoice</th>
                        <th>Pelanggan</th>
                        <th class="text-end">Total</th>
                        <th class="text-end">Bayar</th>
                        <th class="text-end">Kembalian</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center" style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($sale->total_amount) }}</td>
                            <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($sale->paid_amount) }}</td>
                            <td class="text-end">{{ \App\Helpers\FormatHelper::formatRupiah($sale->change_amount) }}</td>
                            <td class="text-center">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('sales.show', $sale) }}" 
                                       class="btn btn-sm btn-primary"
                                       style="background-color: var(--lego-yellow); border-color: var(--lego-yellow); color: var(--lego-black);">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('sales.print', $sale) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-primary"
                                       style="background-color: var(--lego-red); border-color: var(--lego-blue);">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <form action="{{ route('sales.destroy', $sale) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-primary"
                                                style="background-color: var(--lego-yellow); border-color: var(--lego-black);">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                    <p class="mb-0">Belum ada data penjualan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $sales->links() }}
        </div>
    </div>
</div>

<!-- Tambahkan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection 