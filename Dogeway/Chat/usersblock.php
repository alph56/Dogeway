<html>

  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM usuario WHERE unique_id = {$user->getUniqueId()}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <img src="../Registro/archivos/<?php echo $row['fotografia']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['nombre'] . " " . $row['apellidos'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Selecciona un usuario para iniciar el chat</span>
        <input type="text" placeholder="Buscar un chat...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</html>
