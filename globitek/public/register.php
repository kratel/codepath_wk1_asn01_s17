<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.
  $fname = "";
  $lname = "";
  $uname = "";
  $emails = "";
  $errors = array();


  // if this is a POST request, process the form
  // Hint: private/functions.php can help
  if(is_post_request()):

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php
    $fname = $_POST["fname"];
    $_fname = db_escape($db, $fname);
    $lname = $_POST["lname"];
    $_lname = db_escape($db, $lname);
    $emails = $_POST["emails"];
    $uname = $_POST["uname"];

    if(is_blank($_POST["fname"])){
      $errors[] = "Please Include a First Name";
    } elseif (!has_length($_POST["fname"],['max' => 255, 'min' => 2])) {
      $errors[] = "First Name must be between 2 and 255 characters";
    } elseif (!preg_match('/^\A[a-zA-Z\s\-\,\.\']+\Z$/',$fname)) {
      $errors[] = "First Name may only contain letters, whitespace and symbols: (-) dashes (,) commas (.) periods and (') single quotes";
    }

    if(is_blank($_POST["lname"])){
      $errors[] = "Please Include a Last Name";
    } elseif (!has_length($_POST["lname"],['max' => 255, 'min' => 2])) {
      $errors[] = "Last Name must be between 2 and 255 characters";
    } elseif (!preg_match('/^\A[a-zA-Z\s\-\,\.\']+\Z$/',$lname)) {
      $errors[] = "Last Name may only contain letters, whitespace and symbols: (-) dashes (,) commas (.) periods and (') single quotes";
    }

    if(is_blank($_POST["emails"]) || !has_valid_email_format($_POST["emails"])) {
      $errors[] = "Please Include a Valid Email";
    } elseif (!preg_match('/^[a-zA-Z0-9\_\@\.]+$/',$_POST['emails'])) {
      $errors[] = "Email may only contain letters, numbers and symbols: (_) underscore (@) at and (.) period";
    }

    if(is_blank($_POST["uname"])){
      $errors[] = "Please Include a Username";
    } elseif (!has_length($_POST["uname"],['max' => 255,'min'=>8])) {
      $errors[] = "Username must be between 8 and 255 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9\_]+$/',$_POST['uname'])) {
      $errors[] = "Username may only contain letters, numbers and symbols: (_) underscore";
    }

    //check for username
    $uname = $_POST["uname"];
    $q_uname = "SELECT * FROM users WHERE username='$uname';";
    $result_uname = db_query($db, $q_uname);
    if ($result_uname != false && db_num_rows($result_uname) > 0){
      $errors[] = "Username already exists";
    }


    // if there were no errors, submit data to database
    if(empty($errors)){

      // Write SQL INSERT statement, only allow unique usernames
      $date = date("Y-m-d H:i:s");
      //$sql = "INSERT INTO users (first_name, last_name, email, username, created_at)
      //VALUES ('$fname','$lname', '$emails', '$uname', '$date');";
      
      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at) ";
      $sql .= "SELECT '$_fname','$_lname', '$emails', '$uname', '$date' ";
      $sql .= "WHERE NOT EXISTS (SELECT 1 FROM users WHERE username='$uname');";
      

      // For INSERT statments, $result is just true/false
      $result = db_query($db, $sql);
      if($result) {
        db_close($db);

      //   TODO redirect user to success page
        header("Location: ../public/registration_success.php");

      } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
        echo db_error($db);
        db_close($db);
        exit;
      }
    }

  endif;

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php //include('../private/functions.php');
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    if(!empty($errors)){
      echo display_errors($errors);
    }

  ?>
  <!-- TODO: HTML form goes here -->
  <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
    <table>
      <tr>
        <td>
          First Name: <br><input type="text" name="fname" <?php if(!empty($_POST["fname"])) {echo 'value="'.$fname.'"';} ?>>
        </td>
      </tr>
      <tr>
        <td>
          Last Name: <br><input type="text" name="lname" <?php if(!empty($_POST["lname"])) {echo 'value="'.$lname.'"';} ?>>
        </td>
      </tr>
      <tr>
        <td>
          Email: <br><input type="text" name="emails" <?php if(!empty($_POST["emails"])) {echo "value='".$_POST["emails"]."'";} ?>>
        </td>
      </tr>
      <tr>
        <td>
          Username: <br><input type="text" name="uname" <?php if(!empty($_POST["uname"])) {echo "value='".$_POST["uname"]."'";} ?>>
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" value="Submit">
        </td>
      </tr>

    </table>
  </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
