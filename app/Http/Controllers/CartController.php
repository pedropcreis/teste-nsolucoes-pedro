<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function mercadoPagoCheckout() {

        \MercadoPago\SDK::setAccessToken('TEST-6126144999769461-072808-2ea38a3340203f779db0a4f3ca000d6e-411133990');

        $preference = new \MercadoPago\Preference();

        // Cria um item na preferência (dados fictícios p/ teste)
        $item = new \MercadoPago\Item();
        $item->title = 'Meu produto';
        $item->quantity = 1;
        $item->unit_price = 75.56;

        $preference->items = array($item);
        $preference->save();
        dd($preference);
    }
}
