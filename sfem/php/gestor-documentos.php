<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Documentacion - Hospital de Clinicas</title>
    <!-- ESTE HREF ES SOLO UNA FUENTE (Inter), LOS NUMEROS SON EL GROSOR -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/estiloGD.css">
</head>
<body>
    <header class="barra-nav">
        <div class="logo-nav">
            <img src="../imgs/logo_clinicas.png" height="75px">                
        </div>

        <div class="titulo-nav">GESTOR DE DOCUMENTACION</div>

        <div class="btns-nav">
            <a href="trazabilidad.php" class="btn-traza"><i class="fa-solid fa-truck-medical"></i> Trazabilidad</a>
                        
            <div class="info-user">
                <div class="avatar"><i class="fa-regular fa-user"></i></div>
                <div class="user-info">
                    <span class="user-label">USUARIO:</span>
                    <span class="user-name">Dr. Serrano</span>
                </div>
            </div>

            <button type="button" class="btn-cierre" title="Cerrar Sesion">
                <a href="logout.php" class="btn-nav"><i class="fa-solid fa-right-from-bracket"></i></a>
            </button>
        </div>
    </header>

    <main class="principal">

        <!-- SUBIR NUEVO DOCUMENTO-->
        <section class="nuevo-doc">
            <div class="titulo-sec">
                <h2>NUEVO DOCUMENTO</h2>
            </div>

            <form>
                <div class="area-arch">
                    <label class="titulo-area">ARCHIVO:</label>
                    <div class="buscador">
                        <input type="text" placeholder="Seleccione un archivo clinico..." readonly>
                        <button type="button" class="btn-buscar">EXAMINAR</button>
                    </div>
                </div>

                <div class="area-cat">
                    <label class="titulo-area">CATEGORISA:</label>
                    <select class="selec-cat">
                        <option>Categoria 1</option>
                        <option>Categoria 2</option>
                        <option>Categoria 3</option>
                    </select>
                </div>

                <div class="area-desc">
                    <label class="titulo-area">DESCRIPCION:</label>
                    <textarea class="text-desc" placeholder="Ingrese notas clinicas o descripcion del documento..."></textarea>
                </div>

                <div class="area-acc">
                    <button type="button" class="btn-guardar">GUARDAR</button>
                </div>
            </form>
        </section>

        <!-- HISTORIAL DE DOCUMENTACION-->
        <section class="historial">
            <div class="titulo-sec">
                <h2>HISTORIAL DE DOCUMENTOS</h2>
            </div>

            <div class="tabla-histo">
                <table class="edit-tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CATEGORIA</th>
                            <th>USUARIO</th>
                            <th>FECHA</th>
                            <th>ACTUALIZACION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Categoria 1</td>
                            <td>Dr. Serrano</td>
                            <td>2023-10-01</td>
                            <td>2023-10-01</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Categoria 2</td>
                            <td>Dr. Garcia</td>
                            <td>2023-10-02</td>
                            <td>2023-10-02</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Categoria 3</td>
                            <td>Dr. Lopez</td>
                            <td>2023-10-03</td>
                            <td>2023-10-03</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="botones">
                <button type="button" class="btn-editar">EDITAR</button>
                <button type="button" class="btn-borrar">BORRAR</button>
            </div>
        </section>
    </main>

    <button type="button" class="btn-crear-usuario">
        <a href="crear-usuario.php"><i class="fa-solid fa-user-plus"></i> CREAR USUARIO</a>
    </button>

</body>
</html>