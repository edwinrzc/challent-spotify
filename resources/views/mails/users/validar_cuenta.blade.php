<html lang="es">

<head>
    <title>Challent - Bienvenida</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1, user-scalable=no" />
</head>

<body style="margin: 30px 0px 0px 0px; border: none; background-color: #f5f5f5;">
    <table style="width:100%; max-width: 960px; margin: 0 auto; background-color:#f5f5f5; border-spacing: 0px;">
        <tr>
            <th style="width: 100%; padding: 15px 15px; background-color:#ffffff;">
                <!--img style="width: 250px; height:auto;" src="{{asset('images/images_mail/logo_onehouser-01.png')}}" -->
            </th>
        </tr>
        <tr>
            <th style="width:100%;"></th>
        </tr>
        <tr>
            <th style="border-spacing: 0px;">
                <p style="font-family: 'Raleway', sans-serif;font-size: 20px;line-height:25px; color:#ffffff; margin: 0px; padding: 15px; background-color:#c60000">
                    <strong style="font-weight:600; text-transform: uppercase; letter-spacing: 0.5px;">¡Bienvenido a Challent!</strong>
                </p>
            </th>
        </tr>
        <tr>
            <th style="background-color:#ffffff; padding: 15px;">

                <p style="font-family: 'Raleway', sans-serif;font-size: 15px;line-height:25px; color:#515151; margin: 15px 0px 0px 0px; font-weight: 400;">
                    Valida tu usuario
                </p>
                <p style="font-family: 'Raleway', sans-serif;font-size: 15px;line-height:25px; color:#515151; margin-top: 15px; font-weight: 400;">Confirmanos este mail para validar tu usuario.
                </p>
            </th>
        </tr>

        <tr>
            <th style="background-color:#ffffff; padding: 15px;">
                <a href="{{ $link }}" style="font-family: 'Raleway', sans-serif;background-color: #c60000; color: #ffffff; font-weight: 600; padding: 15px; text-decoration: none; display: inline-block; margin: 0px 0px 0px 0px;">Verificar usuario</a>
            </th>
        </tr>
        <tr>
            <th style="background-color:#ffffff;padding: 15px 15px 0px 15px;">
                <p style="font-family: 'Raleway', sans-serif;font-size: 15px;line-height:25px; color:#515151; margin: 0px 0px 0px 0px;">Si el botón no funciona, copiá el siguiente link en tu navegador:</p>
            </th>
        </tr>
        <tr>
            <th style="background-color:#ffffff;padding: 0px 15px 15px 15px;">
                <a href="{{ $link }}" style="color:#c60000;font-weight: 600; text-decoration: none; font-family: 'Raleway', sans-serif;font-size: 15px;line-height:25px; margin: 0px 0px 0px 0px; display: inline-block;">{{ $link }}</a>
            </th>
        </tr>
        <tr>
            <th style="background-color:#ffffff;">
                <p style="font-family: 'Raleway', sans-serif;font-size: 15px;line-height:25px; color:#515151; margin: 0px 0px 0px 0px; font-weight: 400;">¡Éxito!</p>
            </th>
        </tr>

        <tr>
            <th style="background-color:#ffffff;">
                <p style="font-family: 'Raleway', sans-serif;font-size: 15px;line-height:25px; color:#515151; margin-top: 30px; margin-bottom: 30px; text-transform: uppercase;">
                    <strong style="font-weight:900;">Equipo Challent</strong>
                </p>
            </th>
        </tr>
    </table>
</body>

</html>