# Prueba Tecnica Entrekids

## Nota

> El archivo datos.json contiene los resultados de la query lanzados en MySql almacenados como JSON, esto lo utilizo a modo de "BBDD" al momento de generar el html, para obtener los datos y generar la tabla con los resultados.<br/>
> El archivo template.html contiene los datos básicos para generar un archivo HTML con una tabla pre-hecha, la cual se llenará con los datos de "datos.json" al momento de ejecutar genera_html.php.

### Respuesta 1

> Query para obtener el id y nombre del vendedor, el total vendido por productos y el total vendido por experiencias, agrupado por nombre y id de los proveedores

<pre>
    <code>
        SELECT 
            p.id,
            p.nombre,
            FORMAT(SUM(CASE
                    WHEN
                        (SELECT 
                                id
                            FROM
                                paquete
                            WHERE
                                item_id = i.id
                            LIMIT 1)
                    THEN
                        (t.total * i.cantidad)
                    ELSE 0
                END),
                0) AS total_productos,
            FORMAT(SUM(CASE
                    WHEN
                        (SELECT 
                                id
                            FROM
                                entrada
                            WHERE
                                item_id = i.id
                            LIMIT 1)
                    THEN
                        (t.total * i.cantidad)
                    ELSE 0
                END),
                0) AS total_experiencia
        FROM
            item AS i
                INNER JOIN
            transaccion AS t ON t.id = i.transaccion_id
                INNER JOIN
            actividad_evento AS av ON av.id = i.evento_id
                INNER JOIN
            actividad AS a ON a.id = av.actividad_id
                INNER JOIN
            proveedor AS p ON a.proveedor_id = p.id
        GROUP BY p.nombre , p.id 
    </code>
</pre>

### Respuesta 2

> Un dato relevante a obtener puede ser el ticket promedio de cada vendedor, ya sea en general o también haciendo la diferencia de si es el promedio de las ventas de productos o experiencias. <br/>
> Sería una lógica similar al SUM(CASE) usado para obtener el total vendido por productos/experiencias, solo que utilizaría un AVG()

### Respuesta 3

> Ejecutar el siguiente comando en la terminal para poder generar el archivo HTML que contiene una tabla resumen de los resultados de la query.
<pre>
<code>
    php genera_html.php
</code>
</pre>