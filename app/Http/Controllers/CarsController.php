<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{
    public function index()
    {
        $id = null;

        if(Auth::id())
        {
            $id = Auth()->user()->id;
        }

        //$car = DB::table('cars')
          //              ->where('created_by', $id)
            //            ->where('payment', '!=', 'SI')
              //          ->get();

        $car = DB::table('cars')
                        ->join('products', 'cars.product_id', '=', 'products.id')
                        ->select('products.name', 'cars.*')
                        ->where('created_by', $id)
                        ->where('payment', '!=', 'SI')
                        ->get();

        return view('cars.index', compact('car'));
    }

    public function tazasindex()
    {
        if(Auth::id())
        {
            $product = 2;
            return view('tazas', compact('product'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function camisasindex()
    {
        if(Auth::id())
        {
            $product = 1;
            return view('camisas', compact('product'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function bannersindex()
    {
        if(Auth::id())
        {
            $product = 3;
            return view('banners', compact('product'));

        }
        else
        {
            return redirect()->back();
        }
    }

    public function storetazas(Request $request)
    {
        $id_user = null;

        if(Auth::id())
        {
            $id_user = Auth()->user()->id;
        }

        $request->validate([
            'product_id' => 'required|int',
            'quantity' => 'required|int',
            'description' => 'required|string'
        ]);

        Car::create([
            'created_by' => $id_user,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => 5.00,
            'total' => (($request->quantity) * 5.00),
            'description' => $request->description,
        ]);

        return redirect('cart.index');
    }

}
