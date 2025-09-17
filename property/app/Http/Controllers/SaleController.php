<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('customer')->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        try {
            // Generate invoice number
            $lastSale = Sale::latest()->first();
            $invoiceNumber = 'INV-' . str_pad(($lastSale ? substr($lastSale->invoice_number, 4) + 1 : 1), 8, '0', STR_PAD_LEFT);

            // Calculate total
            $total = 0;
            foreach ($request->products as $item) {
                $product = Product::find($item['id']);
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi");
                }
                $total += $product->price * $item['quantity'];
            }

            // Validate paid amount
            if ($request->paid_amount < $total) {
                throw new \Exception('Pembayaran kurang dari total belanja');
            }

            // Create sale
            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'invoice_number' => $invoiceNumber,
                'total_amount' => $total,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->paid_amount - $total
            ]);

            // Create sale details and update stock
            foreach ($request->products as $item) {
                $product = Product::find($item['id']);
                
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity']
                ]);

                // Update stock
                $product->update([
                    'stock' => $product->stock - $item['quantity']
                ]);
            }

            DB::commit();
            return redirect()->route('sales.show', $sale)->with('success', 'Transaksi berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'details.product']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        DB::beginTransaction();
        try {
            // Restore product stock
            foreach ($sale->details as $detail) {
                $detail->product->update([
                    'stock' => $detail->product->stock + $detail->quantity
                ]);
            }

            $sale->delete();
            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Print the sale receipt.
     */
    public function print(Sale $sale)
    {
        $sale->load(['customer', 'details.product']);
        return view('sales.print', compact('sale'));
    }
}
