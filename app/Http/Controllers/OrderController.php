<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Orders;
use App\Products;
use Validator;
use Notification;

class OrderController extends BaseController
{
    public function create(Request $request)
    {
        // validate input fields
    	 $validator = Validator::make($request->all(), [
            'product_id' => 'required','quantity' => 'required',            
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        // new Product Request
          $order = new Orders([
            'pro_id' => $request->product_id,
            'quantity' => $request->quantity,            
        ]);
        $order->save();
        $product = Products::find($request->product_id);
        
        $product->available = $product->available - $request->quantity;
        return $this->sendRes('Thank You for your order');
    }
}
