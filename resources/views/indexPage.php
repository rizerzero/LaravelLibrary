<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<div class="container">
		<script type="text/javascript">
		$(document).ready(function(){
			$("#loginbtn").click(function(){
				var jstToken=$("#tokenID").val(); var jqueryData = []; jqueryData[0]=$("#userid").val(); jqueryData[1]=$("#userpass").val();
				$.ajax({type:"POST",url:"login",data:{ '_token':jstToken,loginData:jqueryData}}).done(function(){ alert("Logged In"); 
					window.location.replace(window.location.href);
				});
		});
	});
</script>
	<div class="col-lg-<?php echo elementSize("colsize"); ?>">
		<div class="panel panel-primary" style="<?php echo elementSize("colwidth"); ?>">
			<div class="panel-heading" align="center">Login Panel</div>
			<div class="panel-body">
				<input type = "hidden" id="tokenID" name = "_token" value = "<?php echo csrf_token() ?>">
				<table class="table table-bordered">
					<tr><td>Username</td><td><input type="text" class="form-control" value="admin" id="userid"/></td></tr>
					<tr><td>Password</td><td><input type="password" class="form-control" value="admin123" id="userpass"/></td></tr>
					<tr><td colspan="2" align="center"><button id="loginbtn" class="btn btn-success <?php echo elementSize("button"); ?>">Log In</button></td></tr>
				</table>
			</form>
			</div>
			<div class="panel-footer" align="center"><!-- <strong>&copy; Library; All rights reserved..!</strong>--></div>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-lg-12">
				<div class="panel-footer" align="center"><strong>&copy; Library; All rights reserved..!</strong></div>
		</div>
	</div>
	<?php
?>