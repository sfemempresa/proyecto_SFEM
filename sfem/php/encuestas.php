<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de Satisfaccion - Hospital de Clinicas</title>
    <!-- ESTE HREF ES SOLO UNA FUENTE (Inter), LOS NUMEROS SON EL GROSOR -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/encuestas.css">
</head>
<body>

    <header class="barra-nav">
        <div class="logo-nav">
            <img src="../imgs/logo_clinicas.png" height="75px">               
        </div>

        <button type="button" class="btn-cierre" title="Cerrar Sesion">
                <a href="panel-paciente.php" class="btn-nav"><i class="fa-solid fa-right-from-bracket"></i></a>
        </button>
    </header>

    <main class="principal">
        <section class="encuesta">
            <div class="titulo">
                <h2>Encuesta de Satisfaccion y Comodidad</h2>
            </div>

            <p class="msj-encu">
                Nos importa mucho tu experiencia navegando en nuestro portal. Por favor, tomate un momento para responder esta breve encuesta y dejarnos tus comentarios o recomendaciones.
            </p>

            <!-- PREGUNTA 1 -->
            <form>
                <div class="preguntas">
                    <label class="pregunta">1. ¿Que tan facil y comoda te resulto la navegacion por el sitio?</label>
                    <div class="opciones-radio">
                        <label>
                            <input type="radio" name="nav" value="facil" checked> Facil y comoda
                        </label>
                        <label>
                            <input type="radio" name="nav" value="no facil"> No tan facil y comoda
                        </label>
                        <label>
                            <input type="radio" name="nav" value="dificil"> Dificil y poco comoda
                        </label>
                    </div>
                </div>

                <!-- PREGUNTA 2 -->s
                <div class="preguntas">
                    <label class="pregunta">2. ¿Encontraste facilmente la informacion o procedimiento medico que buscabas?</label>
                    <div class="opciones-radio">
                        <label>
                            <input type="radio" name="found_info" value="si" checked> Si, totalmente
                        </label>
                        <label>
                            <input type="radio" name="found_info" value="parcial"> Parcialmente
                        </label>
                        <label>
                            <input type="radio" name="found_info" value="no"> No con facilidad
                        </label>
                    </div>
                </div>

                <!-- TEXTO DE SUGERENCIA -->
                <div class="preguntas">
                    <label class="pregunta">3. Sugerencias o recomendaciones para mejorar el sitio:</label>
                    <textarea class="area-txt" placeholder="Escribe aqui cualquier comentario, sugerencia o aspecto que te gustaria que mejoremos..."></textarea>
                </div>

                <div class="btns">
                    <button type="submit" class="btn-submit">Enviar Encuesta</button>
                </div>
            </form>
        </section>
    </main>

</body>
</html>