<?php

$datosJSON = json_decode(file_get_contents('./datos.json'));

$table_body = "";

foreach ($datosJSON->datos as $data) {
    $id         = $data->id;
    $nombre     = $data->nombre;
    $total_exp  = number_format($data->total_experiencia, 0, '', '.');
    $total_prod = number_format($data->total_productos, 0, '', '.');

    $table_body .= "<tr>
                        <td> <a href='listado_individual/$id'>$id</a> </td>
                        <td> <a href='listado_individual/$id'>$nombre</a> </td>
                        <td>$$total_prod</td>
                        <td>$$total_exp</td>
                    </tr>";
}


$html_template = file_get_contents('./template.html');

$html_template = str_replace('[cuerpo_tabla]', $table_body, $html_template);

$crear_html = fopen("listado_general.html", "w");
fwrite($crear_html, $html_template);
fclose($crear_html);
