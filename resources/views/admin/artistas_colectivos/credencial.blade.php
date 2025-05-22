<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title>CREDENCIAL DE ARTISTA INDIVIDUAL</title>
    <meta name="GENERATOR" content="CodeCharge Studio 3.0.1.6">
    <style type="text/css">
        .Estilo1 {
            color: #FFFFFF;
            font-size: 5px;
        }
    </style>
</head>
<body>
    <table style="BACKGROUND-IMAGE: url('{{ asset('images/cara_reducida_final.jpg') }}'); WIDTH: 1333px; HEIGHT: 813px" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td style="HEIGHT: 190px; FONT-SIZE: 30px" valign="bottom" align="center"><strong>&nbsp;</strong></td>
        </tr>
        <tr>
            <!-- Puedes ajustar HEIGHT aquí también si quieres más espacio -->
            <td style="HEIGHT: 80px; FONT-SIZE: 2px; padding-top: 0;" valign="top" align="left">
                <table style="WIDTH: 1330px; HEIGHT: 550px;" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <!-- Espacio a la izquierda -->
                        <td style="WIDTH: 55px;" align="center">&nbsp;</td>

                        <!-- FOTO -->
                        <td style="WIDTH: 355px;" valign="top" align="center">
                            <div style="margin-top: 100px;"> <!-- Aumenta este valor si necesitas bajarlo más -->
                                <img style="width: 355px; height: 340px;" src="{{ asset('storage/' . $artista->logo) }}" border="1" alt="Foto del artista"><br>
                                <font color="#000000" size="7">prueba</font>
                            </div>
                        </td>

                        <!-- Espacio entre imagen y texto -->
                        <td style="WIDTH: 30px;" valign="top" align="left">&nbsp;</td>

                        <!-- DATOS -->
                        <td valign="top" align="left">
                            <div style="margin-top: 100px;"> <!-- Igual al de la foto -->
                                <font size="5">
                                    <p style="margin: 0;">
                                        <font size="15">
                                            <strong> </strong>{{ $artista->nombre_denominacion}}<br>
                                            <strong>C.I.: </strong>{{ $artista->ci }} {{ $artista->expedido }}<br>
                                            <strong>Departamento: </strong>{{ $artista->departamento }}<br>
                                            <strong>Categoría: </strong>{{ $artista->categoria->nombre ?? 'N/A' }}<br>
                                            <strong>Fecha de registro: </strong>{{ \Carbon\Carbon::parse($artista->created_at)->format('d/m/Y') }}<br>
                                            <strong>Fecha de Emisión: </strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}
                                        </font>
                                    </p>
                                </font>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>





        <tr>
            <td style="FONT-SIZE: 1px" align="center"><u><font size="18">www.minculturas.gob.bo</font></u></td>
        </tr>
    </table>

    <table style="BACKGROUND-IMAGE: url('{{ asset('images/reverso.jpg') }}'); WIDTH: 1333px; HEIGHT: 813px" border="0" cellspacing="0" cellpadding="0" align="center">
        <!-- Puedes agregar el contenido del reverso aquí -->
    </table>
</body>
</html>
