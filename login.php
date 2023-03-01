<?php $logged_in = false;
  if (isset($_POST["user"]) &&
      isset($_POST["pw"])) {
    if ($_POST["user"] && $_POST["pw"]) {
      $user = $_POST["user"];
      $pw = $_POST["pw"];
      //connect
      $conn = mysqli_connect("localhost", "root", "", "users");
      //check
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      //user select
      $sql = "SELECT pw FROM students WHERE user
          = '$user'";

      $results = mysqli_query($conn, $sql);

      if ($results) {
        $row = mysqli_fetch_assoc($results);
        if ($row["pw"] && $row["pw"] === $pw) {
          $logged_in = true;
          $sql = "SELECT * FROM students";
          $results = mysqli_query($conn, $sql);
          echo "success";
        } else {
       echo "failure";
     }
   } else {
     echo mysqli_error($conn);
   }
   mysqli_close($conn); //disconnect
 } else {
   echo "Nothing was submitted.";
 }
} ?>

<html>
  <header>
    <title>Admin</title>
  </header>
    <body>
    <h1>Admin panel</h1>
    <body>
    <form action="/login.php" method="post">
      <input type="text" name="username">
      <input type="password" name="password">
      <input type="submit">
    </form>
    <table>
      <thead>
        <tr>
          <th>user</th>
          <th>pw</th>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($logged_in && $results) {
          while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td>" . $row["user"] . "</td>";
            echo "<td>" . $row["pw"] . "</td>";
            echo "</tr>";
          }
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
