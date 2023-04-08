<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>用户列表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center py-3">用户列表</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>密码</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 连接数据库
                    $conn = mysqli_connect('你的数据库ip', 'biao', '294531', 'biao');
                    if (!$conn) {
                        die('连接数据库失败：' . mysqli_connect_error());
                    }
                    // 查询用户列表
                    $sql = 'SELECT * FROM users';
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>' . $row['password'] . '</td>';
                            echo '<td>';
                            echo '<div class="btn-group">';
                            echo '<form method="post" action="edit.php">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<button type="submit" class="btn btn-sm btn-warning">编辑</button>';
                            echo '</form>';
                            echo '<form method="post" action="delete.php">';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '<button type="submit" class="btn btn-sm btn-danger">删除</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">暂无用户数据</td></tr>';
                    }
                    // 关闭数据库连接
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <a href="add.php" class="btn btn-primary">添加用户</a>
        </div>
    </div>
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
</body>
</html>