<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Verificación de Identidad (KYC)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="header">Solicitud de Verificación de Identidad (KYC)</p>
            <p>Estimado/a {{ $user->username }},</p>
            @if ($user->kyc_status === 'pending')
                <p>Le informamos que su solicitud de verificación de identidad (KYC) ha sido recibida.</p>
                <p>Nuestro equipo la está procesando.</p>

                <p>Estado actual: <strong>{{ __('Pendiente') }}</strong></p>

                <p>Si su solicitud es aprobada, usted recibirá un correo electrónico con los detalles de la
                    verificación.</p>
                <p>Si su solicitud es rechazada, usted recibirá un correo electrónico con la razón del rechazo.</p>
            @elseif ($user->kyc_status === 'verified')
                <p>Le informamos que su solicitud de verificación de identidad (KYC) ha sido aprobada.</p>

                <p>Estado actual: <strong>{{ __('Verificado') }}</strong></p>

                <p>Gracias por utilizar nuestros servicios.</p>
            @elseif ($user->kyc_status === 'rejected')
                <p>Le informamos que su solicitud de verificación de identidad (KYC) ha sido rechazada.</p>

                <p>Estado actual: <strong>{{ __('Rechazado') }}</strong></p>

                <p>La razón del rechazo es: {{ $user->kyc->rejection_reason }}</p>
                <p>Por favor, intenta nuevamente.</p>
            @endif
            <p class="footer">Atentamente,<br>El Equipo de {{ config('app.name') }}</p>
    </div>
</body>

</html>
