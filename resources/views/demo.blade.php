<?php


        $check = DB::table('coupons')
        ->where('coupon_code',$code)
        ->get();
        if(count($check)=="1"){
            //ok
            $user_id = Auth::user()->id;
            $check_used = DB::table('used_coupons')
            ->where('user_id',$user_id)
            ->where('coupon_id',$check[0]->id)
            ->count();
           if($check_used=="0"){
                //insert used one
            $used_add = DB::table('used_coupons')
            ->insert([
                    'coupon_id' => $check[0]->id,
                    'user_id' => $user_id
            ]);
            $insert_cart_total = DB::table('cart_total')
            ->insert([
                    'cart_totol' => Cart::total(),
                    'discount' => $check[0]->discount,
                    'user_id' => $user_id,
                    'gtotal' =>  Cart::total() - (Cart::total() * $check[0]->discount)/100,
            ]);
            $disnew = $check[0]->discount;
            $gtnew = Cart::total() - (Cart::total() * $check[0]->discount)/100;
            
            //echo "applied";
            ?>