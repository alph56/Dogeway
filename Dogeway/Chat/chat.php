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
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../Registro/archivos/<?php echo $row['fotografia']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['nombre'] . " " . $row['apellidos'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>