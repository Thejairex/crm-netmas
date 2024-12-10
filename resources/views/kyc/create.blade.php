<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYC Verification</title>
</head>
<body>
    <h1>Verificación de Identidad</h1>
    <form action="/kyc/store" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="document_type">Tipo de Documento:</label>
        <select name="document_type" id="document_type" required>
            <option value="passport">Pasaporte</option>
            <option value="id_card">Cédula de Identidad</option>
            <option value="driver_license">Licencia de Conducir</option>
        </select>

        <label for="document_number">Número de Documento:</label>
        <input type="text" name="document_number" id="document_number" required>
        <label for="document_image">Documento (Frontal):</label>
        <input type="file" name="document_image" id="document_image" required>

        <label for="selfie_image">Selfie:</label>
        <input type="file" name="selfie_image" id="selfie_image">

        <button type="submit">Enviar Verificación</button>
    </form>
</body>
</html>
