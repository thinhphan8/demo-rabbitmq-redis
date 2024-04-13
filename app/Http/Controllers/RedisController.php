<?php

namespace App\Http\Controllers;

class RedisController extends Controller
{
    public function index()
    {
        //Testing Redis
//        Redis::set('user:1:first_name', 'Mike');
//        Redis::set('user:2:first_name', 'John');
//        Redis::set('user:3:first_name', 'Kate');
//        for ($i = 1; $i <= 5; $i++) {
//            echo Redis::get('user:' . $i . ':first_name');
//        }

//        var_dump(Redis::get('test_key'));

//        foreach (range(1, 10) as $number) {
//            Redis::set('users:' . $number , json_encode(['user_hash', md5($number . 'user')]));
//        }
//
//        Redis::set('users:1', 'testing a new value');
//
//        return 'testing redis';
//        dd('Test');
        \Log::info('Test');

    }

}
