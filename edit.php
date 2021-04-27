<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name = $_POST['name'];
	$code = $_POST['code'];
	$teacher = $_POST['teacher'];	
	
	// checking empty fields
	if(empty($name) || empty($code) || empty($teacher)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($code)) {
			echo "<font color='red'>Course code field is empty.</font><br/>";
		}
		
		if(empty($teacher)) {
			echo "<font color='red'>Course teacher field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE course SET name='$name', code='$code', teacher='$teacher' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is view.php
		header("Location: view.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM course WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$code = $res['code'];
	$teacher = $res['teacher'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="view.php">View Course</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Course Code</td>
				<td><input type="text" name="code" value="<?php echo $code;?>"></td>
			</tr>
			<tr> 
				<td>Course Teacher</td>
				<td><input type="text" name="teacher" value="<?php echo $teacher;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
