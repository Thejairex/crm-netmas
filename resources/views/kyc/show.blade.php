<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Verificación de KYC</h1>

        <div class="card mb-4">
            <div class="card-header">Información del Cliente</div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Tipo de Documento:</strong> {{ $kycData->document_type }}</p>
                <p><strong>Número de Documento:</strong> {{ $kycData->document_number }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($kycData->status) }}</p>
                <p><strong>Fecha de Verificación:</strong> {{ $kycData->verified_at ?? 'Pendiente' }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Documentos Subidos</div>
            <div class="card-body text-center">
                <p><strong>Imagen del Documento:</strong></p>
                <img src="{{ asset('storage/' . $kycData->document_image) }}" alt="Documento" class="img-fluid mb-3" style="max-height: 400px;">

                @if ($kycData->selfie_image)
                <p><strong>Selfie del Cliente:</strong></p>
                <img src="{{ asset('storage/' . $kycData->document_image) }}" alt="Selfie" class="img-fluid" style="max-height: 400px;">
                @else
                <p>No se subió selfie.</p>
                @endif
            </div>
        </div>

        @if ($kycData->status === 'pending')
        <div class="text-center">
            <form action="{{ route('kyc.update', $kycData->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="btn btn-success">Aprobar</button>
            </form>

            <form action="{{ route('kyc.update', $kycData->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <textarea name="rejection_reason" class="form-control mb-2" placeholder="Motivo de rechazo" required></textarea>
                <button type="submit" class="btn btn-danger">Rechazar</button>
            </form>
        </div>
        @endif
    </div>
</body>

</html>