<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,webstore');
    }

    public function index()
{
    $totalData = Category::count();
    $totalPesananBaru = DB::table('orders')->where('status', 'Baru')->count();
    $totalPesananRefund = DB::table('orders')->where('status', 'Refund')->count();
    return view('dashboard', ['totalData' => $totalData, 'totalPesananBaru' => $totalPesananBaru, 'totalPesananRefund' => $totalPesananRefund]);
}
}
