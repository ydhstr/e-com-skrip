<?php

namespace App\Http\Controllers;
use App\Models\Order;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->only(['index, penjualan_list, pembayaran_list, orderselesai_list, barangdiminati_list,codreport_list, pdf1, orderrefund_list']);
        $this->middleware('auth:api')->only(['get_reports, penjualan, pembayaran, orderselesai, barangdiminati,pembayarancod,pdf1']);
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
    public function orderrefund_list()
    {
        return view('report.refund');
    }
    public function codreport_list()
    {
        return view('report.codreport');
    }
    public function barangdiminati_list()
    {
        return view('report.barangdiminati');
    }
    
    public function beli_list()
    {
        return view('report.pembelian');
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
    ->whereRaw("DATE(order_details.created_at) BETWEEN ? AND ?", [$request->dari, $request->sampai])
    ->groupBy('id_produk', 'nama_barang', 'harga')
    ->get();

        return response()->json([
            'data' => $report
        ]);
}
public function pdf1(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $response = $this->get_reports($request);
        $report = $response->getData()->data;
    return view('report.pdf', compact('report', 'dari', 'sampai'));
    }

    public function penjualan(Request $request)
    {
        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                count(*) as jumlah_dibeli,
                harga - diskon as harga,
                SUM(jumlah) as total_qty'))
            ->whereRaw("date(order_details.created_at) >= '$request->dari'")
            ->whereRaw("date(order_details.created_at) <=' $request->sampai'")
            ->groupBy('id_produk', 'nama_barang', 'harga')
            ->get();
            
        return response()->json([
            'data' => $report
        ]);
    }
    
public function jual(Request $request)
{
    $dari = $request->dari;
    $sampai = $request->sampai;
    $response = $this->penjualan($request);
    $report = $response->getData()->data;
    return view('report.penjualanpdf', compact('report', 'dari', 'sampai'));
}

public function pembayaran(Request $request)
{
    $reports = DB::table('payments')
    ->join('order_details', 'order_details.id_order', '=', 'payments.id_order')
    ->select(DB::raw('
            order_details.id_order,
            order_details.jumlah,
            payments.status,
            payments.created_at,
            payments.no_rekening,
            payments.atas_nama,
            payments.payment'))
        ->whereRaw("date(payments.created_at) >= '$request->dari'")
        ->whereRaw("date(payments.created_at) <=' $request->sampai'")
        ->where('status', 'DITERIMA')
        ->where('payment', 'Transfer')
        ->get();

    return response()->json([
        'data' => $reports
    ]);
}
public function transfer(Request $request)
{
    $dari = $request->dari;
    $sampai = $request->sampai;
    $response = $this->pembayaran($request);
    $report = $response->getData()->data;
    return view('report.transferpdf', compact('report', 'dari', 'sampai'));
}

    public function orderselesai(Request $request)
    {
        $report = DB::table('orders')
        ->join('members', 'members.id', '=', 'orders.id_member')
        ->select(DB::raw('
            members.nama_member,
            orders.invoice,
            orders.grand_total,
            orders.created_at,
            orders.status'))
        ->whereRaw("date(orders.created_at) >= ?", [$request->dari])
        ->whereRaw("date(orders.created_at) <= ?", [$request->sampai])
        ->where('status', 'Selesai')
        ->get();
    
    return response()->json([
        'data' => $report
    ]);
    }
    public function done(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $response = $this->orderselesai($request);
        $report = $response->getData()->data;
        return view('report.selesaipdf', compact('report', 'dari', 'sampai'));
    }

    public function barangdiminati(Request $request)
    {
        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->select(DB::raw('
                nama_barang,
                count(*) as jumlah_dibeli,
                harga,
                warna,
                SUM(jumlah) as total_qty'))
            ->whereRaw("date(order_details.created_at) >= '$request->dari'")
            ->whereRaw("date(order_details.created_at) <=' $request->sampai'")
            ->groupBy('id_produk', 'nama_barang', 'harga')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }
    public function minat(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $response = $this->barangdiminati($request);
        $report = $response->getData()->data;
        return view('report.minatpdf', compact('report', 'dari', 'sampai'));
    }

    public function orderrefund(Request $request)
    {
        $report = DB::table('orders')
        ->join('members', 'members.id', '=', 'orders.id_member')
        ->select(DB::raw('
            members.nama_member,
            orders.invoice,
            orders.grand_total,
            orders.created_at,
            orders.status'))
        ->whereRaw("date(orders.created_at) >= ?", [$request->dari])
        ->whereRaw("date(orders.created_at) <= ?", [$request->sampai])
        ->where('status', 'Refund')
        ->get();
    
    return response()->json([
        'data' => $report
    ]);
    }
    public function kembali(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $response = $this->orderrefund($request);
        $report = $response->getData()->data;
        return view('report.refundpdf', compact('report', 'dari', 'sampai'));
    }

    public function pembayarancod(Request $request)
{
    $reports = DB::table('payments')
    ->join('order_details', 'order_details.id_order', '=', 'payments.id_order')
    ->select(DB::raw('
            order_details.id_order,
            order_details.jumlah,
            payments.status,
            payments.created_at,
            payments.no_rekening,
            payments.atas_nama,
            payments.payment'))
        ->whereRaw("date(payments.created_at) >= '$request->dari'")
        ->whereRaw("date(payments.created_at) <=' $request->sampai'")
        ->where('status', 'DITERIMA')
        ->where('payment', 'COD')
        ->get();

    return response()->json([
        'data' => $reports
    ]);
}
public function cod(Request $request)
{
    $dari = $request->dari;
    $sampai = $request->sampai;
    $response = $this->pembayarancod($request);
    $report = $response->getData()->data;
    return view('report.codpdf', compact('report', 'dari', 'sampai'));
}

public function users(Request $request)
{
    $reports = DB::table('order_details')
    ->join('orders', 'orders.id', '=', 'order_details.id_order')
    ->join('members', 'members.id', '=', 'orders.id_member')
    ->select('members.nama_member', 
            'members.email',  
            DB::raw('SUM(order_details.jumlah) as total_jumlah'),
            DB::raw('SUM(order_details.total) as total_total')
        )
    ->whereRaw("date(order_details.created_at) >= '$request->dari'")
    ->whereRaw("date(order_details.created_at) <= '$request->sampai'")
    ->groupBy('members.nama_member', 'members.email')
    ->get();

return response()->json([
    'data' => $reports
]);
}

public function pembelian(Request $request)
{
    $dari = $request->dari;
    $sampai = $request->sampai;
    $response = $this->users($request);
    $report = $response->getData()->data;
    return view('report.pembelianpdf', compact('report', 'dari', 'sampai'));
}
}
