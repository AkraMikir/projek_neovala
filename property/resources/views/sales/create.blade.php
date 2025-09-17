@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0" style="color: var(--lego-red);">
                        <i class="fas fa-shopping-cart me-2"></i>Transaksi Baru
                    </h2>
                    <a href="{{ route('sales.index') }}" class="btn btn-primary" style="background-color: var(--lego-black); border-color: var(--lego-black);">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
            @csrf
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-4" style="color: var(--lego-red);">
                        <i class="fas fa-user me-2"></i>Informasi Pelanggan
                    </h4>
                    <div class="row">
                        <div class="col-md-8">
                            <select class="form-select form-select-lg @error('customer_id') is-invalid @enderror" 
                                    id="customer_id" 
                                    name="customer_id" 
                                    required>
                                <option value="">Pilih Pelanggan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('customers.create') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-user-plus me-2"></i>Pelanggan Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-4" style="color: var(--lego-red);">
                        <i class="fas fa-box me-2"></i>Produk
                    </h4>
                    <div id="productList">
                        <div class="row mb-3 product-row">
                            <div class="col-md-6 mb-3">
                                <select class="form-select form-select-lg product-select" name="products[0][id]" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                                data-price="{{ $product->price }}" 
                                                data-stock="{{ $product->stock }}">
                                            {{ $product->name }} (Stok: {{ $product->stock }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="input-group input-group-lg">
                                    <input type="number" 
                                           class="form-control quantity-input" 
                                           name="products[0][quantity]" 
                                           placeholder="Jumlah" 
                                           required 
                                           min="1">
                                    <button type="button" 
                                            class="btn btn-primary remove-product" 
                                            style="display: none; background-color: var(--lego-black); border-color: var(--lego-black);">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg w-100" id="addProduct">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Produk
                    </button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-4" style="color: var(--lego-red);">
                        <i class="fas fa-money-bill-wave me-2"></i>Pembayaran
                    </h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Total</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text" style="background-color: var(--lego-yellow); color: var(--lego-black); border-color: var(--lego-yellow);">Rp</span>
                                <input type="text" class="form-control fw-bold" id="total" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Bayar</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text" style="background-color: var(--lego-yellow); color: var(--lego-black); border-color: var(--lego-yellow);">Rp</span>
                                <input type="number" 
                                       class="form-control @error('paid_amount') is-invalid @enderror" 
                                       id="paid_amount" 
                                       name="paid_amount" 
                                       required 
                                       min="0"
                                       placeholder="Masukkan jumlah bayar">
                                @error('paid_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Kembalian</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text" style="background-color: var(--lego-yellow); color: var(--lego-black); border-color: var(--lego-yellow);">Rp</span>
                                <input type="text" class="form-control" id="change" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Simpan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let productCount = 1;

        // Add product row
        document.getElementById('addProduct').addEventListener('click', function() {
            const template = document.querySelector('.product-row').cloneNode(true);
            template.querySelector('.product-select').name = `products[${productCount}][id]`;
            template.querySelector('.quantity-input').name = `products[${productCount}][quantity]`;
            template.querySelector('.remove-product').style.display = 'block';
            
            document.getElementById('productList').appendChild(template);
            productCount++;

            // Reinitialize event listeners
            initializeEventListeners();
        });

        // Remove product row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product') || e.target.closest('.remove-product')) {
                e.target.closest('.product-row').remove();
                calculateTotal();
            }
        });

        // Initialize event listeners for existing elements
        function initializeEventListeners() {
            document.querySelectorAll('.product-select, .quantity-input').forEach(element => {
                element.addEventListener('change', calculateTotal);
            });
        }

        // Calculate total
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.product-row').forEach(row => {
                const select = row.querySelector('.product-select');
                const quantity = row.querySelector('.quantity-input');
                
                if (select.value && quantity.value) {
                    const option = select.options[select.selectedIndex];
                    const price = parseFloat(option.dataset.price);
                    const stock = parseInt(option.dataset.stock);
                    
                    // Limit quantity to available stock
                    if (parseInt(quantity.value) > stock) {
                        quantity.value = stock;
                    }
                    
                    total += price * parseInt(quantity.value);
                }
            });

            document.getElementById('total').value = total.toLocaleString('id-ID');
            calculateChange();
        }

        // Calculate change
        function calculateChange() {
            const total = parseFloat(document.getElementById('total').value.replace(/\./g, '')) || 0;
            const paid = parseFloat(document.getElementById('paid_amount').value) || 0;
            const change = paid - total;
            
            document.getElementById('change').value = change.toLocaleString('id-ID');
        }

        // Initialize
        initializeEventListeners();
        document.getElementById('paid_amount').addEventListener('input', calculateChange);
    });
</script>
@endpush

<!-- Tambahkan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection 