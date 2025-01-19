<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a nuestro sistema</title>
</head>
<body>
    <h1>¡Hola {{ $user->name }}!</h1>
    <p>Te damos la bienvenida a nuestro sistema. Estamos felices de tenerte con nosotros.</p>
    <p>Haz clic en el siguiente enlace para ir a tu dashboard:</p>
    <p><a href="{{ url('/dashboard') }}">Ir al Dashboard</a></p>
    <p>¡Gracias por unirte!</p>
    <p>Atentamente, el equipo de TuApp</p>
</body>
</html>
