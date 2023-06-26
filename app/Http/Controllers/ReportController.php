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
        $this->middleware('auth')->only(['index, penjualan_list, pembayaran_list, orderselesai_list, barangdiminati_list,codreports_list , pdf1']);
        $this->middleware('auth:api')->only(['get_reports, penjualan, pembayaran, orderselesai, barangdiminati,pembayarancod']);
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
    public function codreports_list()
    {
        return view('report.codreport');
    }
    public function barangdiminati_list()
    {
        return view('report.barangdiminati');
    }
    
   /*  public function get_reports(Request $request)
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
        
    } */
    public function pdf1(Request $request)
    {
        // Retrieve the data from the get_reports method
        $reports = $this->get_reports($request);
      
        // Check if the data exists
    if (!empty($reports)) {
        $reportData = $reports->getData()->data;

        // Generate PDF using Laravel's built-in feature
        $pdf = PDF::loadView('report.pdf', ['reports' => $reportData]);

        // Optional: Set PDF filename
        $filename = 'report.pdf';

        // Optional: Set PDF output options (e.g., download, save, etc.)
        $options = [
            'attachment' => true,
        ];
      
            // Output PDF to the browser or save to a file
            return $pdf->download($filename, $options);
        } else {
            return response()->json(['message' => 'No data available for the report.'], 404);
        }
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
        ->whereRaw("date(order_details.created_at) >= ?", [$request->dari])
        ->whereRaw("date(order_details.created_at) <= ?", [$request->sampai])
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
        /* ->where('payment', 'Transfer Bank') */
        ->get();

    return response()->json([
        'data' => $reports
    ]);
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
        /* ->where('payment', 'COD') */
        ->get();

    return response()->json([
        'data' => $reports
    ]);
}

}
