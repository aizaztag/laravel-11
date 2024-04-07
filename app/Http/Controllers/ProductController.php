<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\ProductStatusEnum;


class ProductController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $input = [
            'name' => 'Gold',
            'body' => 'This is a Gold',
            'status' => ProductStatusEnum::Active
        ];

        $product = Product::create($input);

        dd($product);

    }

    public function show()
    {
        $product  = Product::where("status" , ProductStatusEnum::Active)->pluck('status');

        dd($product);
    }
}
