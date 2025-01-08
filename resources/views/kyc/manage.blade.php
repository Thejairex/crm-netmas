<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cuentas Vinculadas</title>
</head>

<body>
    <h1>Gestión de Cuentas Vinculadas</h1>
    <h3>Usuario: {{ auth()->user()->name }} {{ auth()->user()->lastname }}</h3>
    <h3>Correo Electrónica: {{ auth()->user()->email }}</h3>
    <h2>Cuentas Vinculadas</h2>
    @if ($linkedAccounts->isEmpty())
    <p>No tienes cuentas vinculadas.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>Email del Usuario Vinculado</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($linkedAccounts as $linkedAccount)
            <tr>
                <td>{{ $linkedAccount->linkedUser->email }}</td>
                <td>{{ $linkedAccount->status }}</td>
                <td>{{ $linkedAccount->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if($linkedAccounts->count() < 5)
        <h2>Vincular Nueva Cuenta</h2>
        <form action="/link-account" method="POST">
            @csrf
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="linked_user_email" id="email" required>

            <button type="submit">Vincular</button>
        </form>
        @else
        <p>Has alcanzado el límite de 5 cuentas vinculadas.</p>
        @endif
</body>

</html>