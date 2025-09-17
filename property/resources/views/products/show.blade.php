@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Detail Produk</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="200">Nama Produk</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="mt-3">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection 