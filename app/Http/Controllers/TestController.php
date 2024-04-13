<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function AcademicoRegisterApiTesting(Request $request)
    {
        try {
//            Http::post("http://127.0.0.1:8000/register", $request->all());
//            return response()->json($request->all(), 200);

            $encrypted = Crypt::encrypt(json_encode($request));
//            return response()->json($encrypted, 200);
            try {
                $decrypted = json_decode(Crypt::decrypt($encrypted), true);
                // $decrypted will now contain the original data array
                print_r($decrypted);
            } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                // Decryption failed
                echo "Error decrypting data: " . $e->getMessage();
            }
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }
}
