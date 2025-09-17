@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
<style>
.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #ddd;
    background-color: #f8f9fa;
}
.product-image-placeholder {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #ddd;
}
</style>

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0" style="color: var(--lego-red);">Daftar Produk</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Tambah Produk
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
                        <th style="width: 100px">Gambar</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Harga</th>
                        <th class="text-center">Stok</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($product->image)
                                    <!-- Tambahkan ini untuk debugging -->
                                    <!-- {{ asset('storage/' . $product->image) }} -->
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image"
                                         onerror="console.log('Error loading image: ' + this.src)">
                                @else
                                    <div class="product-image-placeholder">
                                        <i class="fas fa-image text-muted" style="font-size: 1.5em;"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td class="text-end">{{ formatRupiah($product->price) }}</td>
                            <td class="text-center">
                                @if($product->stock < 10)
                                    <span class="badge bg-danger">{{ $product->stock }}</span>
                                @elseif($product->stock < 20)
                                    <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($product->description, 50) ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="btn btn-sm btn-primary"
                                       style="background-color: var(--lego-yellow); border-color: var(--lego-yellow); color: var(--lego-black);">
                                        Detail
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" 
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-primary"
                                                style="background-color: var(--lego-black); border-color: var(--lego-black);">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-box fa-3x mb-3"></i>
                                    <p class="mb-0">Belum ada data produk</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>

<!-- Tambahkan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection 