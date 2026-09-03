<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Trazabilidad - Hospital de Clinicas</title>
    <!-- ESTE HREF ES SOLO UNA FUENTE (Inter), LOS NUMEROS SON EL GROSOR -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/trazabilidad.css">
</head>
<body>
    <header class="barra-nav">
        <div class="logo-nav">
            <img src="../imgs/logo_clinicas.png" height="75px">
        </div>

        <div class="titulo-nav">GESTOR DE TRAZABILIDAD</div>

        <div class="btns-nav">
            <a href="gestor-documentos.php" class="btn-gestor"><i class="fa-solid fa-folder-open"></i> Documentación</a>
            
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

        <!-- FORMULARIO DE TRASLADO -->
        <section class="nuevo-tras">
            <div class="titulo-sec">
                <h2>ARMADO DE SOLICITUD DE TRASLADO</h2>
            </div>

            <form>
                <div class="area-soli">
                    <label class="titulo-area">SOLICITUD ID:</label>
                    <select class="selec-soli">
                        <option value="">Seleccione una solicitud pendiente...</option>
                        <option value="101">#101 - Paciente: Juan Perez</option>
                        <option value="102">#102 - Paciente: Maria Rodriguez</option>
                    </select>
                </div>

                <div class="area-tipo">
                    <label class="titulo-area">TIPO DE TRASLADO:</label>
                    <select class="selec-tipo">
                        <option>Paciente</option>
                        <option>Medicamentos</option>
                        <option>Organos</option>
                    </select>
                </div>

                <div class="area-vehi">
                    <label class="titulo-area">VEHICULO (MOVIL):</label>
                    <select class="selec-vehi">
                        <option>Movil 01 (AAA-1234)</option>
                        <option>Movil 02 (BBB-5678)</option>
                        <option>Movil 03 (CCC-9012)</option>
                    </select>
                </div>

                <div class="area-chofer">
                    <label class="titulo-area">CHOFER ASIGNADO:</label>
                    <select class="selec-chofer">
                        <option>Carlos Martinez</option>
                        <option>Roberto Gomez</option>
                        <option>Lucia Fernandez</option>
                    </select>
                </div>

                <div class="area-enfer">
                    <label class="titulo-area">ENFERMERO/S:</label>
                    <div class="asignar">
                        <input type="text" placeholder="Ej: Lic. Mario Silva, Enf. Ana Ríos">
                    </div>
                </div>

                <div class="area-destino">
                    <label class="titulo-area">DIRECCION DESTINO:</label>
                    <div class="destino">
                        <input type="text" placeholder="Ingrese calle, numero y localidad de destino">
                    </div>
                </div>

                <div class="area-extras">
                    <label class="titulo-area">ANNOTACIONES EXTRAS:</label>
                    <textarea class="text-extra" placeholder="Datos que pueden ayudar a resolver la situacion o llegar al destino"></textarea>
                </div>

                <div class="btns">
                    <button type="button" class="btn-guardar">ASIGNAR Y DESPACHAR</button>
                </div>
            </form>
        </section>

        <!-- TRASLADOS EN CURSO -->
        <section class="traslados">
            <div class="titulo-sec">
                <h2>TRASLADOS EN CURSO</h2>
            </div>

            <div class="tabla-tras">
                <table class="edit-tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TIPO TRASLADO</th>
                            <th>MOVIL</th>
                            <th>CHOFER</th>
                            <th>DESTINO</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#099</td>
                            <td>CTI / Cuidado Critico</td>
                            <td>Movil 01</td>
                            <td>Carlos Martinez</td>
                            <td>Av. Italia 2420</td>
                            <td><span class="en-curso">En Trayecto</span></td>
                        </tr>
                        <tr>
                            <td>#100</td>
                            <td>Comun</td>
                            <td>Movil 03</td>
                            <td>Roberto Gomez</td>
                            <td>Bv. Artigas 1550</td>
                            <td><span class="finalizado">Finalizado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>