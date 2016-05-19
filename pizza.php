<?php
error_reporting(0);
$conn = mysql_connect('localhost','root','');
if ($conn) {
	$db= mysql_select_db('sign_up',$conn);
	if ($db) {
	
	}else
        {
	      die('Not Selected Db');
       }
   }
else
{
	die('Not Connected');
}
    /*take values of radio button*/
	if (isset($_POST['size'])) {
		$radio_string=$_POST['size'];
	}

   if (isset($_POST['login'])) {
	/*take values of check box*/
	$chk_string=implode(",", $_POST['topping']);
    $insert=mysql_query('insert into pizza_login set name="'.$_POST['name'].'",pass="'.$_POST['pass'].'",phone="'.$_POST['phone'].'",size="'.$radio_string.'",toppig="'.$chk_string.'"');

	if($insert)
	{
	echo "Inserted";
	}else
	{
		die('Not Inserted');
	}

   }


   /*get data relate to particular id to delete*/
  if (isset($_GET['delete_id'])) {
   	$delete= mysql_query('delete from pizza_login where id="'.$_GET['delete_id'].'"');
   	if($delete)
	{
	 echo "Successfuly deleted";
	}else
	{
		die('Not delete');
	}

   }

   /*get data relate to particular id to edit*/
  if (isset($_GET['edit_id'])) {
   	$edit= mysql_query('select * from pizza_login where id="'.$_GET['edit_id'].'"');
   	if($edit)
	{
	$row_data=mysql_fetch_assoc($edit);
	$chk_btn=explode(",", $row_data['toppig']);

	
	}else
	{
		die('Not edit');
	}

   }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post">
	
	User Name:<input type="text"  name="name" value= "<?php echo $row_data['name'] ?>"><br><br>
    Password:<input type="password"  name="pass" value= "<?php echo $row_data['pass'] ?>"> <br><br>
	Phone:<input type="text"  name="phone" value= "<?php echo $row_data['phone'] ?>"> <br><br>
	
	Size:<br>
       <input type="radio"  name="size" value="Small" <?php if ($radio_btn=="Small") {  echo "checked";}?>> Small<br>
       <input type="radio"  name="size" value="Medium" <?php if ($radio_btn=="Medium") {  echo "checked";}?>> Medium<br>
       <input type="radio"  name="size" value="Large" <?php if ($radio_btn=="Large") {  echo "checked";}?>> Large <br><br>

    Select Topping:<br>
    <input type="checkbox"  name="topping[]" value="Extra Cheese"
    <?php if(in_array("Extra Cheese", $chk_btn))
    {echo "checked";} ?> > Extra Cheese
	<input type="checkbox"  name="topping[]" value="Pepperoni"   <?php if(in_array("Pepperoni", $chk_btn)){echo "checked";} ?>> Pepperoni
    <input type="checkbox"  name="topping[]" value="Sausage"  <?php if(in_array("Sausage", $chk_btn)){echo "checked"; }?> > Sausage<br>
     
    <input type="checkbox"  name="topping[]" value="Mushrooms"  <?php if(in_array("Mushrooms", $chk_btn)){echo "checked"; }?>>Mushrooms
	<input type="checkbox"  name="topping[]" value="Black Olives"  <?php if(in_array("Black Olives", $chk_btn)){echo "checked";} ?>> Black Olives
    <input type="checkbox"  name="topping[]" value="Green Pepeer"  <?php if(in_array("Green Pepeer", $chk_btn)){echo "checked";} ?>> Green Pepeer<br>

    <input type="checkbox"  name="topping[]" value="Tamotao"  <?php if(in_array("Tamotao", $chk_btn)){echo "checked";} ?>> Tamotao
	<input type="checkbox"  name="topping[]" value="Onions"  <?php if(in_array("Onions", $chk_btn)){echo "checked";} ?>> Onions
    <input type="checkbox"  name="topping[]" value="Anchovies"  <?php if(in_array("Anchovies", $chk_btn)){echo "checked";} ?>> Anchovies<br><br>

<?php
   if (isset($_GET['edit_id'])) {
   	?>
     <input type="submit"  value="Update Information" name="login">
     <?php
    }
    else
    {?>
     <input type="submit"  value="Enter My Information" name="login">
   <?php
    }?>
   <input type="reset" value="Reset" name="reset">  <br><br>

   <?php

   $retrive =mysql_query('select * from pizza_login');
   if($retrive)
   {
     
    ?>
   <table border="1">
	<th>Name</th>
	<th>Phone</th>
	<th>Size</th>
	<th>Topping</th>
	<th>Action</th>
	<?php
      while ($getdata=mysql_fetch_array($retrive)) {
	?>
     <tr>
		<td>
		<?php echo $getdata['name']; ?>	
		</td>
	   <td>
		<?php echo $getdata['phone']; ?>	
		</td>
	
		<td>
		<?php echo $getdata['size'];?>		
		</td>
	
		<td>
		<?php echo $getdata['toppig'];?>		
		</td>
		<td>
		<a href="pizza.php?edit_id=<?php echo $getdata['id'];?>">Edit </a> |<a href="pizza.php?delete_id=<?php echo $getdata['id']; ?>">Delete</a>	  	
		</td>
	</tr>

	<?php
    }

   }else
   {
     die("Not retrive");
   }
   ?>  
 </table>                  
</form>
</body>
</html>