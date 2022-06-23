<?php
session_unset();
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title></title>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/login-styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>
  <main>
    <div class="main-page">
      <div class="title-container">
        <div>
          <h3>UiTM RAUB</h3>
          <p>CoLab System</p>
        </div>
      </div>
      <div class="login-form">
        <div>
          <div class="form-container">
            <h5>Welcome to CoLab RAUB!</h5><br>
            <form action="../php/login-valid.php" id="form" method="post">
              <div>
                <input type="text" placeholder="ID" name="id" id="id" pattern="[0-9]+" /><br>
                <input type="password" placeholder="Password" name="password" id="pass" />
                <i class="bi bi-eye-slash" id="togglePassword"></i><br>
                <?php
                $radio = array("Staff", "Student");

                for ($i = 0; $i < count($radio); $i++) {
                  $j = $i + 1;
                  echo "<input type='radio' id='$radio[$i]' name='user' value='$j' onchange='changePlaceholder()' />";
                  echo "<label for='$radio[$i]'>$radio[$i]</label>";
                }
                ?>
              </div>
              <div>
                <input type="hidden" id="radioValue" name="radioValue" value="" />
                <?php if (isset($_GET['error'])) { ?>
                  <p class="error"> <?php echo $_GET['error']; ?> </p>
                <?php } ?>
              </div>
              <div>
                <button type="submit">LOGIN</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class=" media-social">
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/login-js.js"></script>

</html>