<?php
  $logged_in = false;
  if (isset($_POST["username"]) &&
      isset($_POST["password"])) {
    if ($_POST["username"] && $_POST["password"]) {
      $username = $_POST["username"];
      $password = $_POST["password"];
      // create connection
      $conn = mysqli_connect("localhost", "root", "", "users");
      // check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      // select user
      $sql = "SELECT password FROM students WHERE username
          = '$username'";

      $results = mysqli_query($conn, $sql);

      if ($results) {
        $row = mysqli_fetch_assoc($results);
        if ($row["password"] && $row["password"] === $password) {
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
   mysqli_close($conn); // close connection
 } else {
   echo "Nothing was submitted.";
 }
}
?>
<html>
  <header>
    <title>Admin</title>
  </header>
    <body>
    <h1>Admin panel</h1>
    <body>
    <form action="/admin.php" method="post">
      <input type="text" name="username">
      <input type="password" name="password">
      <input type="submit">
    </form>
    <table>
      <thead>
        <tr>
          <th>username</th>
          <th>password</th>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($logged_in && $results) {
          while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "</tr>";
          }
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
