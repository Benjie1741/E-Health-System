<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/login.css">
  </head>

<body>
  <div>
    <h2 style="text-align: center;">eHealth Login - Arjun Individual</h2>
    <button onclick="document.getElementById('id01').style.display='block'" >Patient Login</button>
    <button onclick="document.getElementById('id02').style.display='block'">Doctor Login</button>
  </div>
  <div id="id01" class="modal">
    <form class="modal-content animate" action="./authentication/checkPatLogin.php" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>
      <div class="container">
        <label for="email"><b>Patient Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit">Login</button>
      </div>
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </form>
  </div>

  <div id="id02" class="modal2">
    <form class="modal-content animate" action="./authentication/checkDocLogin.php" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>
      <div class="container">
        <label for="email"><b>Doctor Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>        
        <button type="submit">Login</button>
      </div>
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>

<!-- Script for displaying modal -->
<script>
  var modal = document.getElementById('id01');
  var modal2 = document.getElementById('id02');
  window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
  }
</script>