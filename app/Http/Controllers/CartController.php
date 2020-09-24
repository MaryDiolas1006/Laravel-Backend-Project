<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (session()->has('cart')) {
                $units = Unit::find(array_keys(session('cart')));

                return view('carts.index')
                    ->with('units', $units);
            } else {
                return view('carts.index');
            }
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemTicketBasket  $itemTicketBasket
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemTicketBasket  $itemTicketBasket
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemTicketBasket  $itemTicketBasket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $unit = Unit::find($id);
            if ($unit->status_id !== 1) {
                $toastMessage = "Unit is not available";
            } else {
                if ($request->session()->exists("cart.$id")) {
                    $toastMessage = "Unit is already in the Request Form!";
                } else {
                    $request->session()->put("cart.$id");
                    $toastMessage = "Unit is successfully added to Request Form! You have " . count(session('cart')) . " unit/s in the request form!";
                }
            }

            $units = Unit::all();
            return back()
                ->with('show', 'show')
                ->witH('toastMessage', $toastMessage)
                ->with('units', $units);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemTicketBasket  $itemTicketBasket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            session()->forget("cart.$id");

            if (count(session()->get('cart')) === 0) {
                session()->forget('cart');
            }

            return back()->with('message', "Subject was removed from your request form.")->with('alert', 'warning');
        } else {
            return abort(403, 'This action is unauthorized.');
        }

    }


     public function clear()
    {
        if (Auth::check()) {
            session()->forget('cart');
            return back();
        }
    }
}
