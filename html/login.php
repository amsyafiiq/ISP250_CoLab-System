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
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>
  <header></header>
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
              <input type="text" placeholder="username" name="username" /><br>
              <input type="text" placeholder="password" name="password" id="pass" /><br>
              <input type="radio" id="staff" name="user" value="1" />
              <label for="staff">Staff</label>
              <input type="radio" id="student" name="user" value="2"" />
              <label for=" student">Student</label><br><br>
              <?php if (isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?> </p>
              <?php } ?><br>
              <button type="submit">LOGIN</button>
              <button type="button">hello</button>
            </form>
          </div>
        </div>
      </div>
      <div class="media-social"></div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/login-js.js"></script>

</html>