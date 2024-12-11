<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Lista de Solicitudes KYC</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kycs as $kyc)
                <tr>
                    <td>{{ $kyc->id }}</td>
                    <td>{{ $kyc->user->name }} {{ $kyc->user->lastname }}</td>
                    <td>{{ $kyc->document }}</td>
                    <td>{{ $kyc->status }}</td>
                    <td>
                        @if ($kyc->status === 'pending')
                            <a href="{{ route('kyc.show', $kyc) }}">Ver"></a>
                        @endif
                        <form action="{{ route('kyc.destroy', $kyc) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>