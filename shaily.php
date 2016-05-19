<?php 
error_reporting(0);
$con = mysql_connect('localhost','root','');
if (mysql_select_db('register_db',$con)) {
	echo "";
}else{	
	edie('DB Not Connected') ;
}

if (isset($_POST['send'])) {

	$sql=mysql_query('insert into register set f_name="'.$_POST['f_name'].'",l_name="'.$_POST['l_name'].'",s_name="'.$_POST['s_name'].'",dob="'.$_POST['dob'].'",gender="'.$_POST['gender'].'",country="'.$_POST['country'].'",email="'.$_POST['email'].'",
	pass="'.$_POST['pass'].'",c_pass="'.$_POST['c_pass'].'",agree="'.$_POST['agree'].'",phone="'.$_POST['phone'].'"');


if($sql)
{
	echo"Inserted";
}else{
	echo "data not Inserted";	
}



}

$fetch_data= mysql_query('select * from register');
/*to fetch data from table use var_dumb*/
    if (isset($_GET['id'])) {

    $del=$_GET['id'];
	mysql_query("delete from register where id=$del");
	header('Location:shaily.php');
    // echo "delete * from register where id=$del";

	}

	if (isset($_GET['edit_id'])) {

    $edit=$_GET['edit_id'];
    echo $edit;
	$edit_data=mysql_query("select * from register where id=$edit");
	$row=mysql_fetch_array($edit_data);
    // echo "delete * from register where id=$del";

	}

	if (isset($_POST['update'])) {
  
    $sqlupdate=mysql_query('update register set f_name="'.$_POST['f_name'].'",l_name="'.$_POST['l_name'].'",s_name="'.$_POST['s_name'].'",dob="'.$_POST['dob'].'",gender="'.$_POST['gender'].'",country="'.$_POST['country'].'",email="'.$_POST['email'].'",
	pass="'.$_POST['pass'].'",c_pass="'.$_POST['c_pass'].'",agree="'.$_POST['agree'].'",phone="'.$_POST['phone'].'" where id="'.$_GET['edit_id'].'"');

      header('Location:shaily.php');

	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign UP</title>
</head>
<body>
<form method="POST">
	First Name<input type="text" name="f_name" value= "<?php echo $row['f_name'] ?>"><br><br>
	Last Name<input type="text" name="l_name"  value= "<?php echo $row['l_name'] ?>"><br><br>
	Screen Name<input type="text" name="s_name" value= "<?php echo $row['s_name'] ?>"><br><br>
	Date of Birth<input type="date" name="dob" value= "<?php echo $row['dob'] ?>>"><br><br>

	Gender
	<input type="radio" name="gender" value="male" checked> Male
    <input type="radio" name="gender" value="female"> Female<br><br>

	Country<input type="text" name="country" value= "<?php echo $row['country'] ?>"><br><br>
	E-Mail<input type="text" name="email" value= "<?php echo $row['email'] ?>"><br><br>
	Phone<input type="text"  name="phone" value= "<?php echo $row['phone'] ?>"><br><br>
	Password<input type="text" name="pass" value= "<?php echo $row['pass'] ?>"><br><br>
	Confirm Password<input type="text" name="c_pass" value= "<?php echo $row['c_pass'] ?>"><br><br>
	<input type="checkbox" name="agree">I Agree to the term Use<br><br>


	<?php 

	if (isset($_GET['edit_id'])) {
		?>
		<input type="submit" value="Update" name="update">
		<?php }else {?>
	<input type="submit" value="Send" name="send">
	<?php } ?>
	
	<input type="submit" value="Cancel" name="Cancel">
	
</form>

	<table border="1" bgcolor="#FFFFFF">
	<th>First Name</th>
	<th>Last Name</th>
	<th>E-Mai</th>
	<th>Country</th>
	<th>Phone No</th>
	<th>Action</th>

<?php	
while($array=mysql_fetch_array($fetch_data))
{
/*	print_r($array);*/

?>
	<tr>
	<td>
	<?php
	echo $array['f_name'];
	?>
	</td>

	<td>
	<?php
		echo $array['l_name'];
		?>
	</td>
	<td>
	<?php
		echo $array['email'];
	?>
	</td>
	<td>
	<?php
		echo $array['country'];
	?>
	</td>
	<td>
	<?php
		echo $array['phone'];
	?>
	</td>
	<td>
		<a href = "shaily.php?edit_id=<?php  echo $array['id'];?>">edit </a>| <a href = "shaily.php?id=<?php echo $array['id']; ?>">delete </a>
	
	</td>
	</tr>
	
<?php 
}

?>
</table>

</body>
</html>