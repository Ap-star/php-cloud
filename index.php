<?php 
	
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "1212", "todo");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {

		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$query = "INSERT INTO tbl_tasks (task) VALUES ('$task')";
			mysqli_query($db, $query);
			header('location: index.php');
		}
	}	

	// delete task
	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];

		mysqli_query($db, "DELETE FROM tbl_tasks WHERE task_id=".$id);
		header('location: index.php');
	}

	// select all tbl_tasks if page is visited or refreshed
	$tbl_tasks = mysqli_query($db, "SELECT * FROM tbl_tasks");

?>
<!DOCTYPE html>
<html>

<head>
	<title>ToDo List Application PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Application PHP and MySQL database</h2>
	</div>


	<form method="post" action="index.php" class="input_form">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>


	<table>
		<thead>
			<tr>
				<th>N</th>
				<th>Tasks</th>
				<th style="width: 60px;">Action</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 1; while ($row = mysqli_fetch_array($tbl_tasks)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td class="task"> <?php echo $row['task']; ?> </td>
					<td class="delete"> 
						<a href="index.php?del_task=<?php echo $row['task_id'] ?>">x</a> 
					</td>
				</tr>
			<?php $i++; } ?>	
		</tbody>
	</table>

</body>
</html>