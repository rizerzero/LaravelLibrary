<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();
		$("#AddMemberBtn").click(function(e){
			var jstToken=$("#tokenID").val();
			var memberAddData = [];
			memberAddData[0]=$("#memberName").val();
			memberAddData[1]= $("input[name='gender']:checked").val();
			memberAddData[2]=$("#emailID").val();
			memberAddData[3]=$("#birthdate").val();
			memberAddData[4]=$("#address").val();
			memberAddData[5]=$("#phone").val();
			$.ajax({type:"POST",url:"addThisMember",data:{'_token':jstToken,addmember:memberAddData}}).done(function(fromController){
				$("#memberCardModal").modal("show");
				$("#memName").html(fromController.memName);
				$("#memID").html(fromController.memID);
				$("#memAddress").html(fromController.address);
				$("#memPhone").html(fromController.phone);
				//$("#memBarCode").html(fromController.bookName);
				$.ajax({type:"POST",url:"showBarCode",data:{'_token':jstToken,code:fromController.memID}}).done(function(res){
						document.getElementById("memBarCode").src=window.location.href+""+res.targetFilePath;
				});
			});
		});
	});
function printDiv(divID){
  divToPrint=document.getElementById(divID);
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
}
</script>
	<div class="row">
		<div class="col-lg-12">

		<div id="memberCardModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" align="right"><button  class="btn btn-danger" data-dismiss="modal">X</button></div>
				<div class="modal-body">
					<div class="memberCardBody" id="memberCardPrint">
						<table class="table table-bordered" align="center">
	<tr><td colspan="3" align="center" id="memName"><strong></strong></td></tr>
	<tr><td rowspan="4" align="center"><img id="memBarCode" src=""/><br><span id="memID"></span></td></tr>
	<tr><td><strong>Address:</strong></td><td id="memAddress"></td></tr>
	<tr><td><strong>Mobile No:</strong></td><td id="memPhone"></td></tr>
						</table>
					</div>
				</div>
			<div class="modal-footer" align="center"><button class="btn btn-sm btn-default" onclick="printDiv('memberCardPrint')">Print</button></div>
		</div>
	</div>
</div>
		<div class="panel panel-info">
			<div class="panel-heading" align="center">Add a Member</div>
			<div class="panel-body">
				<table class="table table-bordered">
<tr><td>Name:</td><td><input class="form-control" type="text" id="memberName"/></td></tr>
<tr><td>Gender:</td><td><input type="radio" checked="checked" name="gender">Male<input type="radio" value="Female" name="gender">Female</td></tr>
<tr><td>Email:</td><td><input class="form-control" type="email" id="emailID"/></td></tr>
<tr><td>Birthdate:</td><td><input class="form-control" type="date" id="birthdate"/></td></tr>
<tr><td>Address:</td><td><input class="form-control" type="text" id="address"/></td></tr>
<tr><td>Phone No:</td><td><input class="form-control" type="text" id="phone"/></td></tr>
<tr><td colspan="2" align="center"><button id="AddMemberBtn" class="btn btn-info">Add Member</button></td></tr>
</table>
			</div>
			<!-- <div class="panel-footer" align="center">&nbsp;</div> -->
		</div>

		</div>
		</div>
<div class="row">&nbsp;</div>
	<?php
?>