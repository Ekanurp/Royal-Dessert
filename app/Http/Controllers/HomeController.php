<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produks = Produk::all();
        $cartitems = CartFacade::getContent();
        return view('home', compact('produks', 'cartitems'), [
            'title' => 'Royal Desserts',
        ]);
    }

    public function adminHome()
    {
        return view('adminHome', [
            'title' => 'Admin Home',
        ]);
    }

    public function addToCart(Request $request)
    {
        CartFacade::add([
            'id' => $request->id,
            'name' => $request->nama,
            'price' => $request->harga,
            'quantity' => 1,
            'attributes' => [
                'gambar' => $request->gambar,
            ],
        ]);

        return redirect()->route('home');
    }

    public function removeCart(Request $request)
    {
        CartFacade::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('home');
    }

    public function clearAllCart()
    {
        CartFacade::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('home');
    }
}
