<?php

namespace App\Services;

use Exception;
use Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;

class MercadoPagoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);


    }

    public function createPreference($items, $payer)
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1,
            "default_payment_method_id" => "amex",
        ];

        $backUrls = [
            "success" => route('payment.success'),
            "failure" => route('payment.failure'),
            "pending" => route('payment.pending'),
        ];

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "Netmas",
            "external_reference" => "ORDER-" . time(),
            "expires" => false,
            // "notification_url" => route('webhook'),
            "auto_return" => 'approved',
        ];
        // dd($request);
        return $request;
    }

    public function createPaymentPreference($product)
    {
        $items = [
            [
                'id' => $product->id,
                'title' => $product->name,
                'description' => $product->description,
                'quantity' => 1,
                'category_id' => 'services',
                'unit_price' => $product->calculateTotalPrice(),
                // 'currency_id' => '',

            ]
        ];

        $user = auth()->user();
        $payer = [
            "name" => $user->name,
            "last_name" => $user->lastname,
            "surname" => $user->lastname,
            "email" => $user->email,

        ];

        $request = $this->createPreference($items, $payer);

        try {
            $client = new PreferenceClient();
            $preference = $client->create($request);
            return $preference;

        } catch (MPApiException $e) {
            return $e->getMessage();
        }
    }

    public function getPaymentByExternalReference($exteral_reference)
    {
        try {
            $request = new MPSearchRequest(10, 1);
            $request->external_reference = $exteral_reference;
            $client = new PreferenceClient();
            $preference = $client->search($request);

            return $preference;
        } catch (MPApiException $e) {
            return $e->getMessage();
        }
    }

    public function getPaymentById($paymentId){
        try {
            $client = new PaymentClient();
            $payment = $client->get($paymentId);
            Log::info('payment info', [
                'payment' => $payment
            ]);

            return $payment;
        } catch (MPApiException $e) {
            $response = $e->getApiResponse()->getContent();
            Log::error("Error al obtener el pago", [
                'message' => $e->getMessage(),
                'response' => $response,
            ]);

        }
    }
}
