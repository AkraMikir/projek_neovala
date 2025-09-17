@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Detail Pelanggan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="200">Nama</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $customer->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $customer->email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $customer->address ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>{{ $customer->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="mt-3">
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection 