<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYC Verification</title>
</head>
<body>
    <h1>Verificación de Identidad</h1>
    <form action="{{ route('kyc.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="document_type">Tipo de Documento:</label>
        <select name="document_type" id="document_type" required>
            <option value="passport">Pasaporte</option>
            <option value="id_card">Cédula de Identidad</option>
            <option value="driver_license">Licencia de Conducir</option>
        </select>

        <label for="document_front">Documento (Frontal):</label>
        <input type="file" name="document_front" id="document_front" required>

        <label for="document_back">Documento (Reverso):</label>
        <input type="file" name="document_back" id="document_back">

        <label for="selfie_with_document">Selfie con Documento:</label>
        <input type="file" name="selfie_with_document" id="selfie_with_document" required>

        <button type="submit">Enviar Verificación</button>
    </form>
</body>
</html>
