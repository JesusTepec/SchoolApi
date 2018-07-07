<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School RESTFULL</title>
</head>
<body>
    <h2>Bienvenidos</h2>
    <h3>Servicio web RESTFUL</h3>
    <p>
        <b>Requisitos Previos</b><br>
        <p>Se necesita de un api_token la cual debe ser agregada a las cabeceras de las peticiones
            <br>
            El api_token es proporcionado en el documento "Documentacion.pdf"
            <br>
            Ejemplo de cabecera:
    <pre>    {
     'Content-Type' => 'application/json'
     'api_token' => {api_token}
    }</pre>
        </p>
        <b>Accion POST</b><br>
        <p>Da de alta una nueva calificacion
            <br>
            <code>localhost:8080/calificaciones</code>
            <br>
            <br>
            Ejemplo Request body:
            <br>
            <br>
            <code>{
                "id_t_materias": 1,
                "id_t_usuarios": 1,
                "calificacion": 10
                }</code>
        </p>
        <b>Accion GET</b><br>
        <p>Lista las calificaciones de un alumno más el promedio
            <br>
            <code>localhost:8080/calificaciones/{idAlumno}</code>
            <br>
            Ejemplo Response 200:
            <br>
            <br>
            <code>[
                {
                "id_t_usuarios": 1,
                "nombre": "John",
                "apellido": "Dow",
                "materia": "ingenieria de sofware",
                "calificacion": "9.50",
                "fecha_registro": "07/07/2018"
                },
                {
                "promedio": 9.5
                }
                ]</code>
        </p>
        <b>Accion PUT</b><br>
        <p>Actualiza una calificacion
            <br>
            <code>localhost:8080/calificaciones/{idCalificacion}</code>
            <br>
            Ejemplo Request body:
            <br>
            <br>
            <code>{
                "calificacion": 9.5
                }</code>
        </p>
        <b>Accion DELETE</b><br>
        <p>Elimina una calificacion
            <br>
            <code>localhost:8080/calificaciones/{idCalificacion}</code>
            <br>
            Ejemplo Response 200:
            <br>
            <br>
            <code>{
                "success": "ok",
                "msg": "calificacion eliminada"
                }</code>
        </p>
    </p>
</body>
</html>