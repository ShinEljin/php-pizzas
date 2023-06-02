<?php

include "./database/connect_db.php";

//check GET request id params
if (isset($_GET["id"])) {
  $id = mysqli_real_escape_string($conn, $_GET["id"]);

  //make sql query
  $query = "SELECT * FROM pizzas WHERE id = $id";

  //get the query result
  $result = mysqli_query($conn, $query);

  //fetch result in array format
  $pizza = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);
}

if (isset($_POST["delete"])) {
  $id_to_delete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);

  $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

  if (mysqli_query($conn, $sql)) {
    //success
    header("Location: index.php");
  } else {
    echo "query error: " . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include "./components/header.php" ?>
<div class="container center">
  <?php if ($pizza) : ?>
    <h4><?php echo htmlspecialchars($pizza["title"]) ?></h4>
    <p>Createdy by: <?php htmlspecialchars($pizza["email"]) ?></p>
    <p><?php echo date($pizza["created_at"]) ?></p>
    <h5>Ingredients</h5>
    <p><?php echo htmlspecialchars($pizza["ingredients"]) ?></p>

    <!-- DELETE FORM -->
    <form action="details.php" method="POST">
      <input type="hidden" name="id_to_delete" value="<?php echo $pizza["id"] ?>">
      <button class="btn brand z-depth-0" name="delete">Delete</button>
      </input>
    <?php else : ?>
      <h5>No such pizza exists!</h5>
    <?php endif; ?>

</div>
<?php include "./components/footer.php" ?>

</html>