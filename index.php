<?php 
/*panggil file header.php */
require_once ('header.php'); 
?>
<div class="login">
<div class="judul">Login</div>
	<!--div class="info ui-corner-all {$msg["type"]}" style="margin:10px 5px 5px 5px;">
            {$msg["content"]}
    </div-->

    <center><?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message'],"error") : ""; ?></center>
    <form id="form" name="login" method="post" action="login.php">
        <table border="0">
          <tr>
            <td>Username </td>
            <td>:</td>
            <td><input name="username" type="text" /></td>
          </tr>
          <tr>
            <td>Password </td>
            <td>:</td>
            <td><input name="password" type="password" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Login" /></td>
          </tr>
          <tr>
            <td colspan="3" align="center"><a href="#">Lupa Password?</a></td>
          </tr>
        </table>
        <!--select name="speed" id="speed">
			<option>Slower</option>
			<option>Slow</option>
			<option selected="selected">Medium</option>
			<option>Fast</option>
			<option>Faster</option>
		</select-->
    </form>
</div>
<?php 
unset($_SESSION['message']); 
require_once ('footer.php'); 
?>