<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    include_once "php/config.php";
    
    $userSession = new UserSession();
    $user = new User();
    
    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    } else {
      header("Location: ../Inicio/index.php");
      exit();
    } 
?>

<?php include_once "header.php";?>

<?php include_once "usersblock.php";?>

<body>
  <div class="wrapper2">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = mysqli_query($conn, "SELECT * FROM usuario WHERE unique_id = {$user_id}");
        $sql_match = mysqli_query($conn, "SELECT
        m1.nombreMascota AS nombrem1,
        m1.id AS idMascotonga,
        m2.nombreMascota AS nombrem2,
        `match`.*
        FROM
        `match`
        LEFT JOIN
        mascota AS m1 ON `match`.idMascota1 = m1.id
        LEFT JOIN
        mascota AS m2 ON `match`.idMascota2 = m2.id
        WHERE
        ((`match`.id1 = {$user->getUniqueId()} AND `match`.id2 = {$user_id}) OR
        (`match`.id1 = {$user_id} AND `match`.id2 = {$user->getUniqueId()})) AND
        (`match`.status = 4 OR `match`.status = 5 OR `match`.status = 6)
        ORDER BY
        `match`.fecha DESC");
        
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        }
        if (mysqli_num_rows($sql_match) > 0) {
          $row_match = mysqli_fetch_assoc($sql_match);
          if ($row_match['status'] == 4) {
            $status_palabra = '💚';
          } elseif ($row_match['status'] == 5) {
              $status_palabra = '⭐';
          }elseif ($row_match['status'] == 6) {
            $status_palabra = '🥰';
          } else {
            $status_palabra = '❌';
          }

          $sqlRating = mysqli_query($conn, "SELECT ROUND(AVG(rating), 1) as promedio FROM rating WHERE idUser = {$user_id}");
          
          if ($sqlRating) {
            $fila = mysqli_fetch_assoc($sqlRating);
            $promedio = $fila['promedio'];
            } else {
            echo "Error" . mysqli_error($conn);
            }
      } 
        else {
          header("location: users.php");
        }
        

        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img class="foto" src="../Registro/archivos/<?php echo $row['fotografia']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['nombre'] . " " . $row['apellidos'] ?></span>
          <p><?php echo $row_match['nombrem1']. " " .$status_palabra. " " .$row_match['nombrem2']; ?></p>
        </div>

        <div class="reportar">
          <button id="btnReportar" onclick="mostrarCuadroReporte('<?php echo $user->getUniqueId();?>',<?php echo $user_id?>)"> 
            <i class="fas fa-flag custom-icon with-border"></i>
          </button>
          <div id="cuadroReporte" style="display:none;">
              <label for="motivoReporte">Motivo del reporte:</label>
              <input type="text" id="motivoReporte" name="motivoReporte">
              <button type="button" class="boton" onclick="cancelarReporte()">Cancelar</button>
              <button type="button" class="boton" onclick="confirmarReporte()">Enviar</button>
          </div>
        </div>
        <div class="bloquear">
            <?php $idAdopcion1 = $row_match['idMascotonga'];?>
            <button onclick="confirmarBloqueo('<?php echo $user->getUniqueId();?>' , '<?php echo $user_id; ?>', '<?php echo $idAdopcion1; ?>')">
            <i class="fas fa-ban custom-icon with-border"></i>
            </button>
        </div>
    
        <div class="rating">
          <button onclick="mostrarRating('<?php echo $user_id;?>');"> 
          <i class="fas fa-star custom-icons with-border"></i>
          </button>
          <?php 
           
          echo $promedio;?>

            <div id="cuadroRating">
                <div id="rating">
                <span class="estrella" data-valor="1">&#9733;</span>
                <span class="estrella" data-valor="2">&#9733;</span>
                <span class="estrella" data-valor="3">&#9733;</span>
                <span class="estrella" data-valor="4">&#9733;</span>
                <span class="estrella" data-valor="5">&#9733;</span>
                <button type="button" class="boton" onclick="cancelarRating()">Cancelar</button>
                <button type="button" class="boton" onclick="confirmarRating()">Enviar</button>
            </div>
                
          </div>
        </div>

      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area" id="typebar">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
    </div>

  <script src="javascript/chat.js"></script>

</body>

</html>

<script src="javascript/jquery-3.3.1.min.js"></script>

<script>

function confirmarBloqueo(TuId, ElId, mascota){

    console.log('idUsuario:', TuId);
    console.log('idBloqueo:', ElId);
    console.log('idM:', mascota);
    var confirmacion = confirm('¿Estás seguro de bloquear a este usuario?');
    if (confirmacion) {
        $.ajax({
            type: 'POST', 
            url: 'php/bloqueo.php',
            data: {
                idUsuario: TuId,
                idBloqueo: ElId,
                idM: mascota
            },
            
            success: function(response) {
                console.log('Respuesta del servidor:', response);

                if (response == 'bloqueado') {
                    alert('Usuario bloqueado');
                    $("#typebar").html('<div id="mensajeBloqueado">Match cancelado.</div>');
                }
                else {
                    console.log('Cancelado el bloquear');
                }
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX ', error);
            }
        });
    } else {
        console.log('Cancelado el bloquear');
    }
}

function confirmarReporte() {
    var motivoReporte = $("#motivoReporte").val();

    $("#cuadroReporte").hide();

    $.ajax({
        type: 'POST', 
        url: 'php/reporte.php',
        data: {
            idUsuario: window.TuIdGlobal,
            idBloqueo: window.ElIdGlobal,
            motivoReporte: motivoReporte
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response);

            if (response == 'reportado') {
                alert('Usuario reportado');
            } else {
                console.log('Cancelado el reporte');
            }
        },
        error: function(error) {
            console.error('Error en la solicitud AJAX ', error);
        }
    });
}

function cancelarReporte() {
    $("#cuadroReporte").hide();
}

function mostrarCuadroReporte(TuId, ElId) {
    $("#cuadroReporte").show();

    window.TuIdGlobal = TuId;
    window.ElIdGlobal = ElId;

    $("#motivoReporte").focus();
}

  var ratingSeleccionado; 

  $(".estrella").click(function () {
    var valor = $(this).data("valor");

    $(".estrella").removeClass("iluminada");

    $(".estrella").each(function () {
      if ($(this).data("valor") <= valor) {
        $(this).addClass("iluminada");
      }
    });

    ratingSeleccionado = valor;
  });

  function confirmarRating() {
    $("#cuadroRating").hide();

    if (typeof ratingSeleccionado !== 'undefined') {
      $.ajax({
        type: 'POST',
        url: 'php/rating.php',
        data: {
          idUsuario: window.TuIdGlobal,
          rating: ratingSeleccionado
        },
        success: function (response) {
          console.log('Respuesta del servidor:', response);

          if (response == 'rating') {
          } else {
            console.log('Cancelado el rating');
          }
        },
        error: function (error) {
          console.error('Error en la solicitud AJAX ', error);
        }
      });
    } else {
      console.log('No se ha seleccionado ninguna estrella.');
    }
  }

function cancelarRating() {
    $("#cuadroRating").hide();
  }

  function mostrarRating(TuId) {
    $("#cuadroRating").show();
    window.TuIdGlobal = TuId;
    $("#rating").focus();
  }



</script>