<!DOCTYPE html>
<html>
<head>
    <title>Compra Exitosa</title>
    <style>
        /* Tailwind CSS styles */
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($purchase->status == 'approved')
        <div class="header">¡Gracias por tu compra, {{ $user->name }}!</div>
        <div class="content">
            <p>Tu compra ha sido realizada con éxito. Aquí tienes los detalles de tu compra:</p>
            <ul>
                <li><strong>ID de compra:</strong> {{ $purchase->id }}</li>
                <li><strong>Producto:</strong> {{ $purchase->product->name }}</li>
                <li><strong>Precio:</strong> ${{ $purchase->total }}</li>
                <li><strong>Fecha de compra:</strong> {{ $purchase->created_at->format('d/m/Y') }}</li>
            </ul>
            <p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>
        </div>
        <div class="footer">Atentamente, el equipo de TuApp</div>
        @elseif ($purchase->status == 'failure')
        <div class="header">Lo sentimos, tu compra ha sido rechazada.</div>
        <div class="content">
            <h2>Detalles de la compra:</h2>
            <ul>
                <li><strong>ID de compra:</strong> {{ $purchase->id }}</li>
                <li><strong>Producto:</strong> {{ $purchase->product->name }}</li>
                <li><strong>Precio:</strong> ${{ $purchase->total }}</li>
                <li><strong>Fecha de compra:</strong> {{ $purchase->created_at->format('d/m/Y') }}</li>
            </ul>
            <p>Por favor, intenta nuevamente.</p>
        </div>
        <div class="footer">Atentamente, el equipo de TuApp</div>

        @endif
    </div>
</body>
</html>

