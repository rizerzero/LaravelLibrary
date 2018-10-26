<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();
		$("#logout").click(function(e){
			$.ajax({type:"POST",url:"logout",data:{'_token':jstToken}}).done(function(){ alert("Logged Out");
					window.location.replace(window.location.href);
			});
		});
		$(".routeButton").click(function(e){
			var routeID=$(this).attr("id");
			$.ajax({type:"POST",url:"route",data:{'_token':jstToken,routeID:routeID}}).done(function(result){
				$("#content").html(result);
			});
		});
	});
</script>

<div class="row"><div class="col-lg-12">Logged as: <?php echo $un; ?>&nbsp;<input id="tokenID" type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"/><button class="btn btn-danger" id="logout">Logout</button></div></div>
<div class="row">&nbsp;</div>
	<div class="row">
		<div class="col-lg-2"><button id="addBook" class="btn btn-default btn-lg routeButton">Add Book</button></div>
		<div class="col-lg-2"><button id="addMember" class="btn btn-default btn-lg routeButton">Add Member</button></div>
		<div class="col-lg-2"><button id="lendBook" class="btn btn-default btn-lg routeButton">Lend Book(s)</button></div>
		<div class="col-lg-2"><button id="returnBook" class="btn btn-default btn-lg routeButton">Return Book(s)</button></div>
		<div class="col-lg-2"><button id="searchPage" class="btn btn-default btn-lg routeButton">Seacrh Book/Member</button></div>
		<div class="col-lg-2"><button id="infoPage" class="btn btn-default btn-lg routeButton">Information</button></div>
		</div>
<div class="row">&nbsp;</div>
<div id="content"></div>
<?php
?>