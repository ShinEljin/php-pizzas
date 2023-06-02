<?php

include "./database/connect_db.php";



$errors = ["email" => "", "title" => "", "ingredients" => ""];
$email = $title = $ingredients = "";


if (isset($_POST["email"])) {

  if (empty($_POST["email"])) {
    $errors["email"] =  "An Email is required <br />";
  } else {
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "Invalid email <br />";
    }
  }

  if (empty($_POST["title"])) {
    $errors["title"] = "An Title is required <br />";
  } else {
    $title = $_POST['title'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      $errors["title"] = 'Title must be letters and spaces only <br />';
    }
  }

  if (empty($_POST["ingredients"])) {
    $errors["ingredients"] = "An Ingredient is required <br />";
  } else {
    $ingredients = $_POST['ingredients'];
    if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
      $errors["ingredients"] = "Ingredients must be a comma separated list <br />";
    }
  }

  if (array_filter($errors)) {
    // echo "there are errors in the form";
  } else {
    // echo "form is valid";

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $ingredients = mysqli_real_escape_string($conn, $_POST["ingredients"]);

    $sql = "INSERT INTO pizzas(email, title, ingredients) VALUES('$email', '$title', '$ingredients')";

    if (mysqli_query($conn, $sql)) {
      header("Location: index.php");
    } else {
      echo "query error" . mysqli_error($conn);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include "./components/header.php" ?>

<section class="container grey-text">
  <h4 class="center">Add a Pizza</h4>
  <form class="white" action="add.php" method="POST">
    <label>Your Email:</label>
    <input type="text" name="email" type="email" value="<?php echo htmlspecialchars($email) ?>">
    <div class="red-text"><?php echo $errors["email"] ?></div>


    <label>Pizza Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
    <div class="red-text"><?php echo $errors["title"] ?></div>

    <label>Ingredients (comma seperated):</label>
    <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
    <div class="red-text"><?php echo $errors["ingredients"] ?></div>

    <div class="center">
      <button class="btn brand z-depth-0">SUBMIT</button>
    </div>

  </form>
</section>

<?php include "./components/footer.php" ?>

</html>