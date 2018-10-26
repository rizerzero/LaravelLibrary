<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();

		$(".lendMoreBut").on("click",function(e){
		var thisIDNo=Number($('tr.forcopyId').length);
		var nxtNo=thisIDNo+1;
		var trElement=document.createElement("tr");
		trElement.id="copyIdrow".concat(nxtNo);
		var LabelTdElement=document.createElement("td");
		LabelTdElement.id="copyIdlabelTD".concat(nxtNo);
		var inputTdElement=document.createElement("td");
		inputTdElement.id="copyIdinputTD".concat(nxtNo);
		var inputElement=document.createElement("input");
		inputElement.id="copyIdLend".concat(nxtNo);
		document.getElementById("copyIdsLend").appendChild(trElement);
		$("#copyIdrow"+nxtNo).addClass("forcopyId");
		document.getElementById("copyIdrow"+nxtNo).appendChild(LabelTdElement);
		$("#copyIdlabelTD"+nxtNo).html("Copy I.D - "+nxtNo);
		document.getElementById("copyIdrow"+nxtNo).appendChild(inputTdElement);
		document.getElementById("copyIdinputTD"+nxtNo).appendChild(inputElement);
		$("#copyIdLend"+nxtNo).addClass("form-control");
	});
		$(".reduceLendBut").on("click",function(e){
			var thisIDNo=Number($('tr.forcopyId').length);
			$("#copyIdrow"+thisIDNo).remove();
	});
		$("#LendBtn").click(function(e){
			var jstToken=$("#tokenID").val();
			var copyLendData = [];
			copyLendData[0]=$("#mem_id_lend").val();
			var thisIDNo=Number($('tr.forcopyId').length);
			for (var i = 1; i <= thisIDNo; i++) {
				copyLendData[i]=$("#copyIdLend"+i).val();
			};
			
			$.ajax({type:"POST",url:"lendBook",data:{'_token':jstToken,submit_lend:copyLendData}}).done(function(res){
				alert(res.result);
			});
			
		});

	});
</script>
	<div class="row">
		<div class="col-lg-12">

				<div class="panel panel-primary">
			<div class="panel-heading" align="center">Lend Copies</div>
			<div class="panel-body">
				<table id="copyIdsLend" class="table table-bordered">
				<tr><td>Member I.D:</td><td colspan="3"><input type="text" class="form-control" id="mem_id_lend"/></td></tr>
<tr id="copyIdrow1" class="forcopyId">
	<td id="copyIdlabelTD1">Copy I.D - 1</td>
	<td id="copyIdinputTD1"><input type="text" class="form-control" id="copyIdLend1"/></td>
	<td align="center"><button id="lendMore" class="btn btn-info lendMoreBut"><strong>+</strong></button></td>
	<td align="center"><button id="reduceLend" class="btn btn-danger reduceLendBut"><strong>-</strong></button></td>
</tr>
		</table>
		</div>
		<div class="panel-footer" align="center"><button id="LendBtn" class="btn btn-primary <?php echo elementSize("button"); ?>">Lend</button></div>
		</div>

		</div>
		</div>
<div class="row">&nbsp;</div>
	<?php
?>