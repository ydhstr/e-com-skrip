<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index, penjualan_list, pembayaran_list, orderselesai_list, barangdiminati_list']);
        $this->middleware('auth:api')->only(['get_reports, penjualan, pembayaran, orderselesai, barangdiminati']);
    }

    
    public function index()
    {
        return view('report.index');
    }
    
    public function penjualan_list()
    {
        return view('report.penjualan');
    }
    
    public function pembayaran_list()
    {
        return view('report.pembayaran');
    
    }
    public function orderselesai_list()
    {
        return view('report.orderselesai');
    }

    public function barangdiminati_list()
    {
        return view('report.barangdiminati');
    }
    
    public function get_reports(Request $request)
    {
        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                count(*) as jumlah_dibeli,
                harga,
                SUM(total) as pendapatan,
                SUM(jumlah) as total_qty'))
            ->whereRaw("date(order_details.created_at) >= '$request->dari'")
            ->whereRaw("date(order_details.created_at) <=' $request->sampai'")
            ->groupBy('id_produk', 'nama_barang', 'harga')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

    public function penjualan(Request $request)
    {
        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                count(*) as jumlah_dibeli,
                harga,
                SUM(jumlah) as total_qty'))
            ->whereRaw("date(order_details.created_at) >= '$request->dari'")
            ->whereRaw("date(order_details.created_at) <=' $request->sampai'")
            ->groupBy('id_produk', 'nama_barang', 'harga')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

    
    public function pembayaran(Request $request)
    {
        $report = DB::table('payments')
            ->join('order_details', 'order_details.id', '=', 'payments.id_order')
            ->join('products', 'products.id', '=', 'order_details.id_order')
            ->select(DB::raw('
                nama_barang,
                jumlah as total_qty,
               status'))
            ->whereRaw("date(payments.created_at) >= '$request->dari'")
            ->whereRaw("date(payments.created_at) <=' $request->sampai'")
            ->groupBy('id_order', 'nama_barang', 'jumlah')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

    
    public function orderselesai(Request $request)
    {
        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                count(*) as jumlah_dibeli,
                harga,
                SUM(jumlah) as total_qty'))
            ->whereRaw("date(order_details.created_at) >= '$request->dari'")
            ->whereRaw("date(order_details.created_at) <=' $request->sampai'")
            ->groupBy('id_produk', 'nama_barang', 'harga')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

    
    public function barangdiminati(Request $request)
    {
        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                count(*) as jumlah_dibeli,
                harga,
                SUM(jumlah) as total_qty'))
            ->whereRaw("date(order_details.created_at) >= '$request->dari'")
            ->whereRaw("date(order_details.created_at) <=' $request->sampai'")
            ->groupBy('id_produk', 'nama_barang', 'harga')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

}
