<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()->count();
        $products = Product::query()->count();
        $orderNumber = Order::query()->active()->count();
        $orders = Order::query()->with('user')->active()->paginate();
        $money = Order::query()->active()->sum('total_amount');

        return view('dashboard.index', compact('users', 'products', 'orders', 'money', 'orderNumber'));
    }

    public function reportindex(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.report.index');
    }
}
