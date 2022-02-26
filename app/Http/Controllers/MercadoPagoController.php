<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MP;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MercadoPagoController extends Controller
{
    public function getCreatePreference(Request $request)
    {
        $preferenceData = [
            'items' => [
                [
                    'id' => $request->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'picture_url' => 'string_base_64...',
                    'quantity' => $request->quantity,
                    'currency_id' => 'ARS',
                    'unit_price' => $request->unit_price
                ]
            ],
        ];

        $preference = MP::create_preference($preferenceData);

        return response()->json($preference);
    }

    /*
     * Debito automatico
     */
    public function getCreatePreapproval(Request $request)
    {
        $preapproval_data = [
            'payer_email' => $request->payer_email,
            'back_url' => 'https://redireccionamiento.com.ar/laravel/public/preapproval',
            'reason' => $request->reason, // Razon, ejemplo: Subscripcion a pack premium.
            'external_reference' => $subscription->id,
            'auto_recurring' => [
                'frequency' => $request->frequency, // Frecuencia de pago.
                'frequency_type' => $request->frequency_type, // Dias, Semanas, Meses...
                'transaction_amount' => $request->transaction_amount,
                'currency_id' => 'ARS',
                'start_date' => Carbon::now()->addHour()->format('d/m/Y'),
                'end_date' => Carbon::now()->addMonth()->format('d/m/Y'),
            ],
        ];

        MP::create_preapproval_payment($preapproval_data);

        return dd($preapproval);
    }
}
