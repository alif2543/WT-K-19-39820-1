<?php
session_start(); 

include('../control/updatecheck.php');


if(empty($_SESSION["username"])) // Destroying All Sessions
{
header("Location: ../control/login.php"); // Redirecting To Home Page
}

?>

<!DOCTYPE html>
<html>
<body>
<h2>Profile Page</h2>

 <h3>Hii, <?php echo $_SESSION["username"];?></h3>

<?php
$radio1=$radio2=$radio3="";
$prof1=$prof2=$prof3=$prof4=$prof5=$prof6="";
$box1=$box2=$box3 = "";
$username=$password=$firstname=$email=$address=$dob=$gender=$interests=$profession="";
$connection = new db();
$conobj=$connection->OpenCon();

$userQuery=$connection->CheckUser($conobj,"student",$_SESSION["username"],$_SESSION["password"]);

if ($userQuery->num_rows > 0) {

    // output data of each row
    while($row = $userQuery->fetch_assoc()) {
      $username=$row["username"];
      $password=$row["password"];
      $firstname=$row["firstname"];
      $email=$row["email"];
      $address=$row["address"];
      $dob=$row["dob"];
      $interests=$row["interests"];
      $intt = explode("+",$interests);
      
      if(  $row["gender"]=="female" )
      { $radio1="checked"; }
      else if($row["gender"]=="male")
      { $radio2="checked"; }
      else{$radio3="checked";}
      
      if(  $row["profession"]=="teacher" )
      { $prof1="selected"; }
      else if($row["profession"]=="student")
      { $prof2="selected"; }
      else if($row["profession"]=="academician")
      { $prof3="selected"; }
      else if($row["profession"]=="doctor")
      { $prof4="selected"; }
      else if($row["profession"]=="engineer")
      { $prof5="selected"; }
      else{$prof6="selected";}

  } 
}
  else {
    echo "0 results";
  }


?>
<form action='' method='post'>
  Username : <input type='text' name='username' value="<?php echo $username; ?>" ><br><br>
  Password : <input type='text' name='password' value="<?php echo $password; ?>" ><br><br>
  First_Name : <input type='text' name='firstname' value="<?php echo $firstname; ?>" ><br><br>
  Email : <input type='text' name='email' value="<?php echo $email; ?>" ><br><br>
  Address : <input type='text' name='address' value="<?php echo $address; ?>" ><br><br>
  DOB : <input type='date' name='dob' value="<?php echo $dob; ?>" ><br><br>

  <label for="profession">Choose a Profession:</label>
  <select id="profession" name="profession">
      <option value="teacher" <?php echo $prof1; ?>>Teacher</option>
      <option value="student" <?php echo $prof2; ?>>Student</option>
      <option value="academician" <?php echo $prof3; ?>>Academician</option>
      <option value="doctor" <?php echo $prof4; ?>>Doctor</option>
      <option value="engineer" <?php echo $prof5; ?>>Engineer</option>
  </select><br><br>

  Gender:
     <input type='radio' name='gender' value='female'<?php echo $radio1; ?>>Female
     <input type='radio' name='gender' value='male' <?php echo $radio2; ?> >Male
     <input type='radio' name='gender' value='other'<?php  $radio3; ?> > Other <br><br>

Interests:
      <input type="checkbox" name="interest[]" value="music" <?php echo (in_array("music", $intt)?'checked':''); ?>>
      <label for="interest[]">Music</label>
      <input type="checkbox" name="interest[]" value="reading" <?php echo (in_array("reading", $intt)?'checked':''); ?>>
      <label for="interest[]"> Reading </label>
      <input type="checkbox" name="interest[]" value="sports" <?php echo (in_array("sports", $intt)?'checked':''); ?>>
      <label for="interest[]">Sports</label>
      <input type="checkbox" name="interest[]" value="gardening" <?php echo (in_array("gardening", $intt)?'checked':''); ?>>
      <label for="interest[]"> Gardening</label>
      <input type="checkbox" name="interest[]" value="travelling" <?php echo (in_array("travelling", $intt)?'checked':''); ?> >
      <label for="interest[]"> Travelling</label><br><br>

    <input name='update' type='submit' value='Update'>  

     <?php echo $error; ?>
<br>
<br>
<a href="../view/pageone.php">Back </a>&nbsp

<a href="../control/logout.php"> Log Out</a>

</body>
</html>