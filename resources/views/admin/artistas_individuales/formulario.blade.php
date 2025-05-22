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
                        <td align="center"><strong>REGISTRO INDIVIDUAL</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <table width="750" border="1">
                                <tr>
                                    <td style="width: 250px;" align="left">
                                        <strong>Fecha de Registro:</strong> {{ \Carbon\Carbon::parse($artista->created_at)->format('d/m/Y') }}<br>
                                        <strong>Departamento:</strong> {{ $artista->departamento }}<br>
                                        <strong>Provincia:</strong> {{ $artista->provincia }}<br>
                                        <strong>Municipio:</strong> {{ $artista->municipio }}<br>
                                        <strong>Comunidad/Nación:</strong> {{ $artista->comunidad }}<br>
                                        <strong>Fecha de Emisión:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                                    </td>
                                    <td align="left">
                                        <strong>Artista:</strong> {{ $artista->nombres }} {{ $artista->apellidos }}<br>
                                        <strong>C.I.:</strong> {{ $artista->ci }}<br>
                                        <strong>Lugar de Nacimiento:</strong> {{ $artista->lugar_nacimiento }} el {{ \Carbon\Carbon::parse($artista->fecha_nacimiento)->format('d/m/Y') }}<br>
                                        <strong>Domicilio:</strong> {{ $artista->domicilio }}<br>
                                        <strong>Teléfono/Celular:</strong> {{ $artista->telefono }}<br>
                                        <strong>Correo Electrónico:</strong> {{ $artista->correo }}
                                    </td>
                                    <td align="center">
                                        <img src="{{ asset('storage/' . $artista->fotografia) }}" width="120" height="120"><br>
                                        {{ $artista->codigo_registro }}
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <table width="750" border="1">
                                <tr>
                                    <td style="padding: 10px;">
                                        <strong>Categoría:</strong> {{ $artista->categoria->nombre ?? 'N/A' }} &nbsp;
                                        <strong>Sub-Categoría:</strong>{{ $artista->subcategoria->nombre ?? 'N/A' }} &nbsp;
                                        <strong>Especialidad:</strong> {{ $artista->especialidad1 }}
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <table width="750" border="1">
                                <tr>
                                    <td>
                                        <strong>Agrupaciones/Instituciones:</strong> {{ $artista->agrupacion }}<br>
                                        <strong>Biografía:</strong><br>
                                        <span style="font-size: 13px;">{!! nl2br(e($artista->biografia)) !!}</span>
                                    </td>
                                </tr>
                            </table>

                            <br><br>

                            <table width="750">
                                <tr>
                                    <td align="center">
                                        ___________________________________<br>
                                        <strong>{{ $artista->nombres }} {{ $artista->apellidos }}</strong><br>
                                        ARTISTA
                                    </td>
                                    <td align="center">
                                        <img src="{{ asset('images/esperanzaministra.png') }}" width="250">
                                    </td>
                                </tr>
                            </table>

                            <br><br>

                            <p style="font-size: 12px; text-align: justify;">
                                El presente documento constituye una declaración jurada, por tanto yo {{ $artista->nombres }} {{ $artista->apellidos }} juro que todos los datos declarados en el presente documento, corresponden a la verdad. De comprobarse la falsedad de alguno de ellos, será sujeto(a) a las sanciones que establece la ley.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
