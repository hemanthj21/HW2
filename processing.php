<html>
  <head>
    <title>Processing</title>
  </head>
  <body>
      <h1>Processing</h1>
      <?php if (isset($_POST["user"]) && isset($_POST["pw"])) {
          if ($_POST["user"] && $_POST["pw"]) {
            $user = $_POST["user"];
            $pw = $_POST["pw"];
          //connect
            $conn = mysqli_connect("localhost", "root", "", "users");
            //check
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //register
            $sql = "INSERT INTO students (user, pw) VALUES
              ('$user', '$pw')";
              $results = mysqli_query($conn, $sql);
              if ($results) {
                echo "The user has been added.";
              } else {
                echo mysqli_error($conn);
              }
              mysqli_close($conn); //disconnect
          } else {
            echo "Username or Password is empty.";
          }
      } else {
        echo "Form was not submitted.";
      } ?>
  </body>
</html>
