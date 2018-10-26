<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();
		$("#summaryButton").click(function(){
			var summaryDate=$("#summaryDate").val();
			var tableTag=document.createElement("table"); tableTag.id="tableID"; document.getElementById('infoDiv').appendChild(tableTag); $("#"+tableTag.id).addClass("table table-bordered");
			var trTag=document.createElement("tr"); trTag.id="trID"; document.getElementById(tableTag.id).appendChild(trTag);
			var tdTag1=document.createElement("th"); tdTag1.id="td1ID"; document.getElementById(trTag.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML="Copy ID";
			var tdTag2=document.createElement("th"); tdTag2.id="td2ID"; document.getElementById(trTag.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML="Member ID";
			var tdTag3=document.createElement("th"); tdTag3.id="td3ID"; document.getElementById(trTag.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML="Activity";
			$.ajax({type:"POST",url:"summary",data:{'_token':jstToken,showSummaryOnThis:summaryDate}}).done(function(showingSummary){
			for (var i = 0; i < showingSummary.rowsNo; i++) {
			var trRow=document.createElement("tr"); trRow.id="trID".concat(showingSummary.jsonData['0'][i]); document.getElementById(tableTag.id).appendChild(trRow);
			var tdTag1=document.createElement("td"); tdTag1.id="copyID".concat(showingSummary.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML=showingSummary.jsonData['1'][i];
			var tdTag2=document.createElement("td"); tdTag2.id="memID".concat(showingSummary.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML=showingSummary.jsonData['2'][i];
			var tdTag3=document.createElement("td"); tdTag3.id="action".concat(showingSummary.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML=showingSummary.jsonData['3'][i];				
			}
			});
		});

		$("#copyHistoryButton").click(function(){
			var copyID4History=$("#copyID4History").val();
			$.ajax({type:"POST",url:"showCopyHistory",data:{'_token':jstToken,showCopyHistory:copyID4History}}).done(function(showingCopyHistory){
			if (showingCopyHistory.rowsNo==0) {
				alert("This Copy has no history..!")
			}
			else{
			var tableTag=document.createElement("table"); tableTag.id="tableID"; document.getElementById('infoDiv').appendChild(tableTag); $("#"+tableTag.id).addClass("table table-bordered");
			var trTag=document.createElement("tr"); trTag.id="trID"; document.getElementById(tableTag.id).appendChild(trTag);
			var tdTag1=document.createElement("th"); tdTag1.id="td1ID"; document.getElementById(trTag.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML="Memeber ID";
			var tdTag2=document.createElement("th"); tdTag2.id="td2ID"; document.getElementById(trTag.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML="Action";
			var tdTag3=document.createElement("th"); tdTag3.id="td3ID"; document.getElementById(trTag.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML="Date";
			for (var i = 0; i < showingCopyHistory.rowsNo; i++) {
			var trRow=document.createElement("tr"); trRow.id="trID".concat(showingCopyHistory.jsonData['0'][i]); document.getElementById(tableTag.id).appendChild(trRow);
			var tdTag1=document.createElement("td"); tdTag1.id="memID".concat(showingCopyHistory.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML=showingCopyHistory.jsonData['1'][i];
			var tdTag2=document.createElement("td"); tdTag2.id="action".concat(showingCopyHistory.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML=showingCopyHistory.jsonData['2'][i];
			var tdTag3=document.createElement("td"); tdTag3.id="date".concat(showingCopyHistory.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML=showingCopyHistory.jsonData['3'][i];				
			}
			}
			});

		});

		$("#memberHistoryButton").click(function(){
			var memberID4History=$("#memberID4History").val();
			$.ajax({type:"POST",url:"showMemberHistory",data:{'_token':jstToken,showMemberHistory:memberID4History}}).done(function(showingMemberHistory){
			if (showingMemberHistory.rowsNo==0) {
				alert("This Member has no history..!")
			}
			else{
			var tableTag=document.createElement("table"); tableTag.id="tableID"; document.getElementById('infoDiv').appendChild(tableTag); $("#"+tableTag.id).addClass("table table-bordered");
			var trTag=document.createElement("tr"); trTag.id="trID"; document.getElementById(tableTag.id).appendChild(trTag);
			var tdTag1=document.createElement("th"); tdTag1.id="td1ID"; document.getElementById(trTag.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML="Copy ID";
			var tdTag2=document.createElement("th"); tdTag2.id="td2ID"; document.getElementById(trTag.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML="Action";
			var tdTag3=document.createElement("th"); tdTag3.id="td3ID"; document.getElementById(trTag.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML="Date";
			for (var i = 0; i < showingMemberHistory.rowsNo; i++) {
			var trRow=document.createElement("tr"); trRow.id="trID".concat(showingMemberHistory.jsonData['0'][i]); document.getElementById(tableTag.id).appendChild(trRow);
			var tdTag1=document.createElement("td"); tdTag1.id="memID".concat(showingMemberHistory.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML=showingMemberHistory.jsonData['1'][i];
			var tdTag2=document.createElement("td"); tdTag2.id="action".concat(showingMemberHistory.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML=showingMemberHistory.jsonData['2'][i];
			var tdTag3=document.createElement("td"); tdTag3.id="date".concat(showingMemberHistory.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML=showingMemberHistory.jsonData['3'][i];				
			}
			}
			});

		});
		$("#deadLinePassedButton").click(function(){
			$.ajax({type:"POST",url:"showCopiesOverdue",data:{'_token':jstToken}}).done(function(showingOverDues){
				if (showingOverDues.rowsNo==0) {
				alert("No overdues..!");
			}
			else{
				alert(showingOverDues.rowsNo);
			var tableTag=document.createElement("table"); tableTag.id="tableID"; document.getElementById('infoDiv').appendChild(tableTag); $("#"+tableTag.id).addClass("table table-bordered");
			var trTag=document.createElement("tr"); trTag.id="trID"; document.getElementById(tableTag.id).appendChild(trTag);
			var tdTag1=document.createElement("th"); tdTag1.id="td1ID"; document.getElementById(trTag.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML="Copy ID";
			var tdTag2=document.createElement("th"); tdTag2.id="td2ID"; document.getElementById(trTag.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML="Member ID";
			var tdTag3=document.createElement("th"); tdTag3.id="td3ID"; document.getElementById(trTag.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML="Date";
			for (var i = 0; i < showingOverDues.rowsNo; i++) {
			var trRow=document.createElement("tr"); trRow.id="trID".concat(showingOverDues.jsonData['0'][i]); document.getElementById(tableTag.id).appendChild(trRow);
			var tdTag1=document.createElement("td"); tdTag1.id="copyID".concat(showingOverDues.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag1); document.getElementById(tdTag1.id).innerHTML=showingOverDues.jsonData['1'][i];
			var tdTag2=document.createElement("td"); tdTag2.id="memID".concat(showingOverDues.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag2); document.getElementById(tdTag2.id).innerHTML=showingOverDues.jsonData['2'][i];
			var tdTag3=document.createElement("td"); tdTag3.id="date".concat(showingOverDues.jsonData['0'][i]); document.getElementById(trRow.id).appendChild(tdTag3); document.getElementById(tdTag3.id).innerHTML=showingOverDues.jsonData['3'][i];				
			}
			}
			});

		});
	});
</script>
	<div class="row">
		<div class="col-lg-12">

			<!-- Modal -->
		<div class="panel panel-default">
			<div class="panel-heading" align="center">Information</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-3" align="center"><div class="panel panel-default"><div class="panel-body"><div class="row"><div class="col-lg-7"><input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" id="summaryDate"/></div><div class="col-lg-5"><button class="btn btn-success" id="summaryButton">View Summary</button></div></div></div></div></div>
					<div class="col-lg-3" align="center"><div class="panel panel-default"><div class="panel-body"><div class="row"><div class="col-lg-6"><input class="form-control" type="text" placeholder="type Copy ID here..." id="copyID4History"/></div><div class="col-lg-6"><button class="btn btn-primary" id="copyHistoryButton">Show Copy History</button></div></div></div></div></div>
					<div class="col-lg-4" align="center"><div class="panel panel-default"><div class="panel-body"><div class="row"><div class="col-lg-6"><input class="form-control" type="text" placeholder="type Member ID here..." id="memberID4History"/></div><div class="col-lg-6"><button class="btn btn-warning" id="memberHistoryButton">Show Member History</button></div></div></div></div></div>
					<div class="col-lg-2" align="center"><div class="panel panel-default"><div class="panel-body"><div class="row"><div class="col-lg-12"><button class="btn btn-danger" id="deadLinePassedButton">Copies Overdue</button></div></div></div></div></div>
				</div>
				<div class="row">
					<div class="col-lg-12" id="infoDiv" align="center"></div>
				</div>
			</div>
			<div class="panel-footer" align="center"><!-- --></div>
		</div>

		</div>
		</div>
<div class="row">&nbsp;</div>

		
		
		




