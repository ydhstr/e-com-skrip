<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,webstore');
    }

    public function index()
    {
        $totalData = Category::count();
        return view('dashboard', ['totalData' => $totalData]);
    }
}
