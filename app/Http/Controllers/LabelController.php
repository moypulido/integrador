<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function print(Request $request)
    {
        $shipping_id = $request->route('shipping_id');
    }
}
