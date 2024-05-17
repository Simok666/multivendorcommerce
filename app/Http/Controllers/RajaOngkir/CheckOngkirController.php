<?php

namespace App\Http\Controllers\RajaOngkir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\Http;

class CheckOngkirController extends Controller
{
    public function checkOngkir (Request $request) {
        try {
            $response = Http::withOptions(['verify' => false,])->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->post('https://api.rajaongkir.com/starter/cost',[
                'origin'        => 151,
                'destination'   => $request->destination,
                'weight'        => 100,
                'courier'       => $request->courier
            ])
            ->json()['rajaongkir']['results'][0]['costs'];

            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'data'    => []
            ]);
        }
    }
}
