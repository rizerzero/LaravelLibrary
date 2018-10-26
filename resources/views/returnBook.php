<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();

		$(".returnMoreBut").on("click",function(e){
		var thisIDNo=Number($('tr.forReturncopyID').length);
		var nxtNo=thisIDNo+1;
		var trElement=document.createElement("tr");
		trElement.id="returncopyIDrow".concat(nxtNo);
		var LabelTdElement=document.createElement("td");
		LabelTdElement.id="returncopyIDlabelTD".concat(nxtNo);
		var inputTdElement=document.createElement("td");
		inputTdElement.id="returncopyIDinputTD".concat(nxtNo);
		var inputElement=document.createElement("input");
		inputElement.id="copyIdReturn".concat(nxtNo);
		document.getElementById("copyIdsReturn").appendChild(trElement);
		$("#returncopyIDrow"+nxtNo).addClass("forReturncopyID");
		document.getElementById("returncopyIDrow"+nxtNo).appendChild(LabelTdElement);
		$("#returncopyIDlabelTD"+nxtNo).html("Copy I.D - "+nxtNo);
		document.getElementById("returncopyIDrow"+nxtNo).appendChild(inputTdElement);
		document.getElementById("returncopyIDinputTD"+nxtNo).appendChild(inputElement);
		$("#copyIdReturn"+nxtNo).addClass("form-control");
	});
		$(".reduceReturnBut").on("click",function(e){
			var thisIDNo=Number($('tr.forReturncopyID').length);
			$("#returncopyIDrow"+thisIDNo).remove();
	});

		$("#ReturnBtn").click(function(e){
			var jstToken=$("#tokenID").val();
			var copyReturnData = [];
			copyReturnData[0]=$("#ref_no_return").val();
			var thisIDNo=Number($('tr.forReturncopyID').length);
			for (var i = 1; i <= thisIDNo; i++) {
				copyReturnData[i]=$("#copyIdReturn"+i).val();
			};
			$.ajax({type:"POST",url:"returnBook",data:{'_token':jstToken,submit_return:copyReturnData}}).done(function(res){
				alert(res.result);
			});
		});

	});
</script>
	<div class="row">
		<div class="col-lg-12">

				<div class="panel panel-warning">
			<div class="panel-heading" align="center">Return Copies</div>
			<div class="panel-body">
<table id="copyIdsReturn" class="table table-bordered">
	<tr><td>Member ID:</td><td><input class="form-control" type="text" id="ref_no_return"/></td></tr>
<tr id="returncopyIDrow1" class="forReturncopyID">
	<td id="returncopyIDlabelTD1">Copy I.D - 1</td>
	<td id="returncopyIDinputTD1"><input type="text" class="form-control" id="copyIdReturn1"/></td>
	<td align="center"><button id="returnMore" class="btn btn-info returnMoreBut"><strong>+</strong></button></td>
	<td align="center"><button id="reduceReturn" class="btn btn-danger reduceReturnBut"><strong>-</strong></button></td>
</tr>
</table>
	</div>
	<div class="panel-footer" align="center"><button class="btn btn-warning <?php echo elementSize("button"); ?>" id="ReturnBtn">Return</button></div>
	</div>

		</div>
		</div>
<div class="row">&nbsp;</div>
	<?php
?>