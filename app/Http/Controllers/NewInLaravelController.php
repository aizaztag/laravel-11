<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\DB;

class NewInLaravelController extends Controller
{
    public function helperFluent()
    {
        $data = [
            "user" => [
                "id" => 1,
                "name" => "user1",
                "email" => "user1@example.com",
                "address"=>[
                    "city" => "ABC"
                ]
            ],
            "posts" => [
                [
                    "postId" => 1,
                    "title" => "Hello, world!"
                ],
                [
                    "postId" => 1,
                    "title" => "Hello, world!"
                ]
            ]
        ];

        return  [
            fluent($data)->collect("posts")->pluck('title'),
            collect($data['posts'])->pluck('title'),
            fluent($data)->scope("user.address")->toJson(),
        ];
    }

    public function collectionSelectUpdate()
    {
        //RateLimited::increment(key:'api:' . $user->id, amount : 2);
        return User::all()->select(['name', 'email'])->toArray();
    }

    public function lateralJoin()
    {


       return Customer::select('customers.name', 'recent_sales.product')
           ->joinSub(function ($query) {
               $query->select('product', 'customer_id')
                   ->from('sales')
                   ->whereColumn('customer_id', 'id')
                   ->orderBy('created_at')
                   ->limit(1);
           }, 'recent_sales', 'recent_sales.customer_id', '=', 'customers.id')
           ->get()
           ->toArray();




        return Customer::select('customers.name', 'recent_sales.product')
                ->joinLateral(
                    Sale::whereColumn('sales.customer_id', 'customers.id')
                          ->orderBy('sales.created_at')
                          ->limit(1),
                          'recent_sales')
            ->get()
            ->toArray();
    }

    public function lateralJoin2()
    {
        return Customer::select('customers.name', DB::raw('(SELECT product FROM sales WHERE sales.customer_id = customers.id ORDER BY sales.created_at ASC LIMIT 1) AS recent_product'))
            ->get()
            ->toArray();
    }

    public function collectSelect()
    {
        $collect =  collect([
                 ['name' => "sdf" , "email"=>"sdf@dfs.com"],
                 ['name' => "ss" , "email"=>"sa@sd.com"],
                ]);
        return $collect->select(['name']);
    }
}
