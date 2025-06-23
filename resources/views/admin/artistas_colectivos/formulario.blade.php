<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro Individual</title>
</head>
<body>
    <table style="width: 740px; height: auto;" align="center">
        <tr>
            <td align="center" style="height: 95px;"></td>
        </tr>
        <tr>
            <td align="center">
                <table border="0" align="center">
                    <tr>
                        <td align="center"><strong>REGISTRO COLECTIVO</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <table width="700" border="1">
                                <tr>
                                    <td style="width: 200px;" align="left">
                                        <strong>Fecha de Registro:</strong> {{ \Carbon\Carbon::parse($artista->created_at)->format('d/m/Y') }}<br>
                                        <strong>Departamento:</strong> {{ $artista->departamento }}<br>
                                        <strong>Provincia:</strong> {{ $artista->provincia }}<br>
                                        <strong>Municipio:</strong> {{ $artista->municipio }}<br>
                                        <strong>Comunidad/Nación:</strong> {{ $artista->comunidad }}<br>
                                        <strong>Fecha de Emisión:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                                    </td>
                                    <td align="left">
                                        <strong>Representante:</strong> {{ $artista->representante->nombres }} {{ $artista->representante->apellidos }}<br>
                                        <strong>C.I.:</strong> {{ $artista->representante->ci }}<br>
                                        <strong>Lugar de Nacimiento:</strong> {{ $artista->lugar_nacimiento }} el {{ \Carbon\Carbon::parse($artista->fecha_nacimiento)->format('d/m/Y') }}<br>
                                        <strong>Domicilio:</strong> {{ $artista->domicilio }}<br>
                                        <strong>Teléfono/Celular:</strong> {{ $artista->telefono }}<br>
                                        <strong>Correo Electrónico:</strong> {{ $artista->correo }}
                                    </td>
                                    <td align="center">
                                        <img src="{{ asset('storage/' . $artista->logo) }}" width="120" height="120" border="1"><br>
                                        {{ $artista->codigo_registro }}
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <table width="700" border="1">
                                <tr>
                                    <td>
                                        <strong>Categoría:</strong> {{ $artista->categoria->nombre}} &nbsp;
                                        <strong>Sub-Categoría:</strong> {{ $artista->subcategoria->nombre }} &nbsp;
                                        <strong>Especialidad:</strong> {{ $artista->especialidad }}
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <table width="700" border="1">
                                <tr>
                                    <td>
                                        <strong>Agrupaciones/Instituciones:</strong> {{ $artista->agrupacion }}<br>
                                        <strong>Biografía:</strong><br>
                                        <span style="font-size: 13px;">{!! nl2br(e($artista->biografia)) !!}</span>
                                    </td>
                                </tr>
                            </table>

                            <br><br>

                            <table width="700">
                                <tr>
                                    <td align="center">
                                        ___________________________________<br>
                                        <strong>{{ $artista->nombre }} {{ $artista->apellido }}</strong><br>
                                        ARTISTA
                                    </td>
                                    <td align="center">
                                        <img src="{{ asset('images/esperanzaministra.png') }}" width="250">
                                    </td>
                                </tr>
                            </table>

                            <br><br>

                            <p style="font-size: 12px; text-align: justify;">
                                El presente documento constituye una declaración jurada, por tanto yo {{ $artista->nombre }} {{ $artista->apellido }} juro que todos los datos declarados en el presente documento, corresponden a la verdad. De comprobarse la falsedad de alguno de ellos, será sujeto(a) a las sanciones que establece la ley.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
