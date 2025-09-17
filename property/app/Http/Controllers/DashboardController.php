<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalSales = Sale::count();
        $recentSales = Sale::with('customer')
                          ->orderBy('created_at', 'desc')
                          ->take(5)
                          ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalSales',
            'recentSales'
        ));
    }
} 