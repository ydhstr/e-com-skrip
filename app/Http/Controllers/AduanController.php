<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AduanController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth:web')->only(['list']);
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    } */

    public function list()
    {  
        return view('aduan.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aduans = Aduan::all();
        return response()->json([
            'data' => $aduans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Aduan = Aduan::all();
        return view('aduan.index', [
            'data' => $Aduan
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
            'nama' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'deskripsi' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }
        $input = $request->all();
        $Aduan = Aduan::create($input);
        return redirect('/aduan')->with(['success' => 'Pesan Berhasil']);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aduan  $Aduan
     * @return \Illuminate\Http\Response
     */
    public function show(Aduan $Aduan)
    {
        /* return response()->json([
            'data' => $Aduan
        ]); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aduan  $Aduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Aduan $Aduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aduan  $Aduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aduan $Aduan)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'deskripsi' => 'required',
        ]);
        $Aduan->update($input);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $Aduan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aduan  $Aduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aduan $Aduan)
    {
        $Aduan->delete();
        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }
}
