<?php

namespace App\Helpers;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement{

    //Añadir item al carrito
    static public function addItemToCartWithQty($product_id, $qty = 1){
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } 
        else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            if($product){
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => $qty, 
                    'total_amount' => $product->price,
                    'unit_amount' => $product->price
                ];
            }
        }
        self::addCartItemsToCookie($cart_items); //Añadir los items del carrito a la cookie
        return count($cart_items); //Devolver el número de items en el carrito
    }

    //Eliminar item del carrito
    static public function removeCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    //Añadir los items del carrito a la cookie
    static public function addCartItemsToCookie($cart_items){
        Cookie::queue('cart_items', json_encode($cart_items), 60*24*30); //30 días que dura la cookie
    }

    //Limpiar los items del carrito de la cookie
    static public function clearCartItemsFromCookie(){
        Cookie::queue(Cookie::forget('cart_items'));
    }

    //Obtener los items del carrito de la cookie

static public function getCartItemsFromCookie(){
    $cart_items = json_decode(Cookie::get('cart_items'), true);
    if (!$cart_items) {
        $cart_items = [];
    }
    return $cart_items;
}


    //Incrementar la cantidad de un item
    static public function incrementItemQuantity($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    //Restar la cantidad de un item
    static public function decrementItemQuantity($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
                
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    //Calcular el total del carrito
    static public function calculateGrandTotal($items){
        
        return array_sum(array_column($items, 'total_amount')); //Sumar el total de todos los items
    }


}