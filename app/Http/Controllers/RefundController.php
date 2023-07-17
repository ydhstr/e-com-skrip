<?php

namespace App\Http\Controllers;
use App\Models\Refund;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class RefundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->only(['list']);
        /* $this->middleware('auth:api')->only(['store', 'update', 'destroy']); */
    }
public function list()
{   $members = Member::all();
    return view('refund.index', compact('members'));
}

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{   
    $refunds = Refund::join('members', 'refunds.id_member', '=', 'members.id')
                    ->select('refunds.*', 'members.nama_member')
                    ->get();
    return response()->json([
        'data' => $refunds
    ]);
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $refund = Refund::all();
    return view('refund.index', [
        'data' => $refund
    ]);
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id_member' => 'required',
        'id_order' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
    ]);

    if ($validator->fails()) {
        return response()->json(
            $validator->errors(),
            422
        );
    }

    $input = $request->all();

    if ($request->has('gambar')) {
        $gambar = $request->file('gambar');
        $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('uploads', $nama_gambar);
        $input['gambar'] = $nama_gambar;
    }

    $refund = Refund::create($input);
    return redirect('/pengembalian')->with(['success' => 'Pesan Berhasil']);
   /*  return response()->json([
        'success' => true,
        'data' => $refund
    ]); */
}

/**
 * Display the specified resource.
 *
 * @param  \App\Models\Refund  $refund
 * @return \Illuminate\Http\Response
 */
public function show(Refund $refund)
{
    /* return response()->json([
        'data' => $refund
    ]); */
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\Refund  $refund
 * @return \Illuminate\Http\Response
 */
public function edit(Refund $refund)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Refund  $refund
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, Refund $refund)
{

    $validator = Validator::make($request->all(), [
        'deskripsi' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(
            $validator->errors(),
            422
        );
    }

    $input = $request->all();

    if ($request->has('gambar')) {
        File::delete('uploads/' . $refund->gambar);
        $gambar = $request->file('gambar');
        $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('uploads', $nama_gambar);
        $input['gambar'] = $nama_gambar;
    } else {
        unset($input['gambar']);
    }

    $refund->update($input);

    return response()->json([
        'success' => true,
        'message' => 'success',
        'data' => $refund
    ]);
}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\Refund  $refund
 * @return \Illuminate\Http\Response
 */
public function destroy(Refund $refund)
{
    File::delete('uploads/' . $refund->gambar);
    $refund->delete();

    return response()->json([
        'success' => true,
        'message' => 'success'
    ]);
}
}
