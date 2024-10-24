<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Models\Order_Item;
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
                        ->orderBy('id')
                        ->get();

        $car_total = DB::table('cars')
                        ->where('created_by', $id)
                        ->where('payment', '!=', 'SI')
                        ->sum('total');

        return view('cars.index', compact('car', 'car_total'));
    }

    public function tazasindex()
    {
        if(Auth::id())
        {
            return view('tazas');
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
            return view('camisas');
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
            return view('banners');

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
            'quantity' => 'required|int',
            'description' => 'required|string'
        ]);

        Car::create([
            'created_by' => $id_user,
            'product_id' => 2,
            'quantity' => $request->quantity,
            'unit_price' => 5.00,
            'total' => (($request->quantity) * 5.00),
            'description' => $request->description,
        ]);

        return redirect('cars');
    }

    public function storebanners(Request $request)
    {
        $id_user = null;

        if(Auth::id())
        {
            $id_user = Auth()->user()->id;
        }

        $request->validate([
            'quantity' => 'required|int',
            'height' => 'required',
            'width' => 'required',
            'description' => 'required|string'
        ]);

        Car::create([
            'created_by' => $id_user,
            'product_id' => 3,
            'quantity' => $request->quantity,
            'unit_price' => 7.00,
            'total' => (($request->quantity) * (($request->height + $request->width) * 7.00)),
            'description' => "Alto: {$request->height}\nLargo: {$request->width}\n{$request->description}",
        ]);

        return redirect('cars');
    }

    public function storecamisas(Request $request)
    {
        $id_user = null;

        if(Auth::id())
        {
            $id_user = Auth()->user()->id;
        }

        $request->validate([
            'quantity' => 'required|int',
            'fit' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string'
        ]);

        Car::create([
            'created_by' => $id_user,
            'product_id' => 1,
            'quantity' => $request->quantity,
            'unit_price' => 6.00,
            'total' => (($request->quantity) * 6.00),
            'description' => "Talla: {$request->fit}\nTipo: {$request->type}\n{$request->description}",
        ]);

        return redirect('cars');
    }

    public function storecar()
    {
        $id_user = null;

        if(Auth::id())
        {
            $id_user = Auth()->user()->id;
        }

        $car_total = DB::table('cars')
                        ->where('created_by', $id_user)
                        ->where('payment', '!=', 'SI')
                        ->sum('total');

        $car = DB::table('cars')
                        ->select('cars.*')
                        ->where('created_by', $id_user)
                        ->where('payment', '!=', 'SI')
                        ->orderBy('id')
                        ->get();
                        
        $order_id = DB::table('orders')
                        ->select('id')
                        ->orderBy('id', 'desc')
                        ->limit(1);

        $order = Order::create([
            'total' => $car_total,
            'created_by' => $id_user,
        ]);

        foreach ($car as $car_item) {
            Order_Item::create([
                'order_id' => $order->id,
                'product_id' => $car_item->product_id,
                'quantity' => $car_item->quantity,
                'unit_price' => $car_item->unit_price,
                'description' => $car_item->description
            ]);

            $car_up = Car::findOrFail($car_item->id);
            $car_up->update([
                'payment' => 'SI',
            ]);
        }

        return view('dashboard');
    }

}
