


	<main>
		<section class="form-container">
    <h2>发布表白</h2>
    <form method="post" onsubmit="return validateForm()">
        <input type="hidden" name="is_logged_in" value="<?php echo isset($_SESSION['user_id']) ? 1 : 0; ?>">
        <label>姓名：</label><input type="text" name="name" required ><br>
        <label>专业：</label><input type="text" name="major" required ><br>
        <label>对方姓名：</label><input type="text" name="to_name" required ><br>  
        <!--编辑框可以用这段代码限制字数maxlength="8"-->
        <label>表白内容：</label><br>
        <textarea name="content" rows="5" cols="50" required></textarea><br>
        <input type="submit" value="发布">
        <?php if (!isset($_SESSION['user_id'])) { ?>
            <p>需要<a href="login.php">登录</a>才能发布信息。</p>
        <?php } ?>
    </form>
			
			<script>
function validateForm() {
  var isLoggedIn = document.getElementsByName('is_logged_in')[0].value;
  if (isLoggedIn == 0) {
    alert('请先登录再发布表白信息！');
    return false;
  }
  return true;
}

function validateForm() {
    var name = document.forms[0]["name"].value;
    var to_name = document.forms[0]["to_name"].value;
    var major = document.forms[0]["major"].value;
    if (name.length > 8 || to_name.length > 8 || major.length > 15) {
        alert("姓名或对方姓名不能超过8个字，专业不能超过15个字");
        return false;
    }
}
</script>

		</section>
		

		<section class="latest-messages">
			<h2>最新的十条表白信息</h2>

				<tbody>
  <?php
      if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "</tr>";
        echo "<tr class='hidden'>";
        echo "<td colspan='6'>";
        echo "<form method='post'>";
        echo "<label>姓名：</label><input type='text' name='name' value='" . $row["name"] . "' readonly><br>";
        echo "<label>专业：</label><input type='text' name='major' value='" . $row["major"] . "' readonly><br>";
        echo "<label>对方姓名：</label><input type='text' name='to_name' value='" . $row["to_name"] . "' readonly><br>";
        echo "<label>表白内容：</label><br>";
        echo "<textarea name='content' rows='5' cols='50' readonly>" . $row["message"] . "</textarea><br>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='6'>暂无表白信息。</td></tr>";
    }
    if ($result->num_rows > 0) {
      $count = 0; // 设置一个计数器，用于限制显示的表格行数
      while ($row = $result->fetch_assoc() && $count < 10) { // 遍历所有表白信息并限制为最新的十条
        $count++;
        ?>
        
        <tr>
          <td>
            <form id="delete-form-<?php echo $row["id"]; ?>" method='post'>
              <label>姓名：</label><input type='text' name='name' value='<?php echo $row["name"]; ?>' readonly><br>
              <label>专业：</label><input type='text' name='major' value='<?php echo $row["major"]; ?>' readonly><br>
              <label>对方姓名：</label><input type='text' name='to_name' value='<?php echo $row["to_name"]; ?>' readonly><br>
              <label>表白内容：</label><br>
              <textarea name='content' rows='5' cols='50' readonly><?php echo $row["message"]; ?></textarea><br>
            </form>
          </td>
        </tr>
        <?php
      }
    } else {
      echo "<tr><td colspan='4'>暂无表白信息。</td></tr>";
    }
    // 关闭数据库连接
    $conn->close();
  ?>
</tbody>
			</table>
			
		</section>
	</main>

	<footer>
		
		<p class="copyright">&copy; 2023 工商表白墙</p>


	</footer>
