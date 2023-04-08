<?php
	session_start();
	$name = $_POST["name"];
	$major = $_POST["major"];
	$to_name = $_POST["to_name"];
	$message = $_POST["message"];

	require_once 'config.php';
		$conn = new mysqli($servername, $username, $password, $dbname);
	// 创建数据库连接
	$conn = new mysqli($servername, $username, $password, $dbname);

	// 检查连接是否成功
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	}

	// 插入新的记录
	$sql = "INSERT INTO biao (user_id, name, major, to_name, message) VALUES ('" . $_SESSION["user_id"] . "', '" . $name . "', '" . $major . "', '" . $to_name . "', '" . $message . "')";

	if ($conn->query($sql) === TRUE) {
	    header("Location: index.php");
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>