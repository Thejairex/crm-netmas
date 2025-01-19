<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class mpPaymentMethod implements PaymentMethod
{
    public function pay($products)
    {
        $items = $this->transformProductsToItems($products);
        $payer = $this->getPayerDetails();
        $paymentMethods = $this->getPaymentMethodsConfig();
        $preferenceRequest = $this->buildPreferenceRequest($items, $payer, $paymentMethods);

        try {
            $client = new PreferenceClient();
            $preference = $client->create($preferenceRequest);
            return $preference;

        } catch (MPApiException $e) {
            Log::error("Error al obtener el pago", [
                'message' => $e->getMessage(),
                'response' => $e->getApiResponse()->getContent(),
            ]);
            return ['error' => $e->getMessage()];
        }
    }

    public function getPaymentMethod($paymentId)
    {
        try {
            $client = new PaymentClient();
            $payment = $client->get($paymentId);
            Log::info('payment info', [
                'payment' => $payment
            ]);

            return $payment;
        } catch (MPApiException $e) {
            Log::error("Error al obtener el pago", [
                'message' => $e->getMessage(),
                'response' => $e->getApiResponse()->getContent(),
            ]);
            return null;
        }


    }
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    private function transformProductsToItems($products)
    {
        return $products->map(function ($item) {
            $product = $item->product;
            return [
                'id' => $product->id,
                'title' => $product->name,
                'description' => $product->description,
                'quantity' => $item->quantity,
                'category_id' => $product->category_id,
                'unit_price' => $product->getTotalPrice(),
            ];
        })->toArray();
    }

    private function getPayerDetails()
    {
        $user = Auth::user();
        return [
            "name" => $user->name,
            "last_name" => $user->lastname,
            "surname" => $user->lastname,
            "email" => $user->email,
        ];
    }

    private function getPaymentMethodsConfig()
    {
        return [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1,
            "default_payment_method_id" => "amex",
        ];
    }

    private function buildPreferenceRequest($items, $payer, $paymentMethods)
    {
        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => [
                "success" => route('payment.success'),
                "failure" => route('payment.failure'),
                "pending" => route('payment.pending'),
            ],
            "statement_descriptor" => "Netmas",
            "external_reference" => "ORDER-" . time(),
            "expires" => false,
            "auto_return" => 'approved',
        ];
    }

}

