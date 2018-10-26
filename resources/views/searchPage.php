<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();
		$('.searchBookOrMember').bind("input", function(){
			var idOfSearch=$(this).attr("id");
			var searchStringAndTable=[]; 
			var targetDiv=""; 
			var targetAnchorClassName=""; 
			var targetListClassName="";
			var targetULid="";
			if (idOfSearch=="searchBookInput") {
				targetDiv="BookSuggesstions";
				targetULid="bookList";
				targetAnchorClassName="linkToBookProfile"; 
				targetListClassName="bookListTagClass"; 
				searchStringAndTable[1]="book";
			}
   			else{
   				targetDiv="MemberSuggesstions";
   				targetULid="memberList";
   				targetAnchorClassName="linkToMemberProfile"; 
   				targetListClassName="memberListTagClass"; 
   				searchStringAndTable[1]="member";
   			}
			$('.'+targetAnchorClassName).remove(); $('.'+targetListClassName).remove(); $('#'+targetULid).remove(); document.getElementById(targetDiv).style.display="none";
			if (($(this).val())){
    			searchStringAndTable[0]=$(this).val();
				$.ajax({type:"GET",url:"search",data:{'_token':jstToken,searchData:searchStringAndTable}}).done(function(result){
					if (result.rowsNo>0){
						document.getElementById(targetDiv).style.display="block";
						var ULTag=document.createElement("ul");
						ULTag.id=targetULid;
						document.getElementById(targetDiv).appendChild(ULTag);
						for (var i = 0; i < result.rowsNo; i++) {
						var listTag=document.createElement("li");
						listTag.id="li_".concat(result.jsonData[0][i]);
						document.getElementById(ULTag.id).appendChild(listTag);
						document.getElementById(listTag.id).className=targetListClassName;
						var anchorTag=document.createElement("a");
						anchorTag.id=result.jsonData[0][i];
						document.getElementById(listTag.id).appendChild(anchorTag);
						document.getElementById(anchorTag.id).className=targetAnchorClassName;
						document.getElementById(anchorTag.id).innerHTML=result.jsonData[1][i];
						document.getElementById(anchorTag.id).href="#";
						}	
					}
					else{
						document.getElementById(targetDiv).style.display="block";
						var ULTag=document.createElement("ul");
						ULTag.id=targetULid;
						document.getElementById(targetDiv).appendChild(ULTag);
						var listTag=document.createElement("li");
						listTag.id="li_";
						document.getElementById(ULTag.id).appendChild(listTag);
						document.getElementById(listTag.id).innerHTML=result.jsonData;
					}
				});
			}
			else{
				$('.'+targetAnchorClassName).remove(); $('.'+targetListClassName).remove(); document.getElementById(targetDiv).style.display="none";
			}

  		});
 		$(document).on('click','.linkToBookProfile',function(){
			var clickedID=$(this).attr("id");
			var forProfile=[];
			forProfile[0]="book";
			forProfile[1]=clickedID;
			$.ajax({type:"POST",url:"profile",data:{'_token':jstToken,viewProfile:forProfile},}).done(function(result){
				document.getElementById("searchBookInput").value=""; 
				document.getElementById("BookSuggesstions").style.display="none";
				$("#copyCardModal").modal("show");
				$("#setBookName").html(result.bookName);
				$("#setBookAuthor").html(result.author);
				$("#setBookLanguage").html(result.bookLanguage);
				str=result.copyIDs;
		    	var copyIDsArray = str.split("~"); var arrayLength=copyIDsArray.length;
						var tableTag=document.createElement("table");
						tableTag.id="tableID";
						document.getElementById('copyIDsList').appendChild(tableTag);
				for (var i = 1; i < arrayLength; i++) {
					$.ajax({type:"POST",url:"showBarCode",data:{'_token':jstToken,code:copyIDsArray[i]}}).done(function(res){
						var codeOnly=(res.imgSrc).substring(0,(res.imgSrc).lastIndexOf("."));
						var trTag=document.createElement("tr");
						trTag.id="trID".concat(codeOnly);
						document.getElementById("tableID").appendChild(trTag);
						var td4img=document.createElement("td");
						td4img.id="tdImage"+"TD".concat(codeOnly);
						document.getElementById(trTag.id).appendChild(td4img);
						var td4Code=document.createElement("td");
						td4Code.id="tdImage"+"CODE".concat(codeOnly);
						document.getElementById(trTag.id).appendChild(td4Code);
						document.getElementById(td4Code.id).innerHTML+=codeOnly;
						var imgTag=document.createElement("img");
						imgTag.id="imageTag".concat(codeOnly);
						document.getElementById(td4img.id).appendChild(imgTag);
						document.getElementById("imageTag"+codeOnly).src+=res.targetFilePath;
						});
				}
			});
 		});
 		$(document).on('click','.linkToMemberProfile',function(){
			var clickedID=$(this).attr("id");
			var forProfile=[];
			forProfile[0]="member";
			forProfile[1]=clickedID;
			$.ajax({type:"POST",url:"profile",data:{'_token':jstToken,viewProfile:forProfile},}).done(function(result){
				document.getElementById("searchMemberInput").value=""; 
				document.getElementById("MemberSuggesstions").style.display="none";
				$("#viewMemberProfileModal").modal("show");
				$("#memName").html(result.memName);
				$("#memID").html(result.memID);
				$("#memAddress").html(result.address);
				$("#memPhone").html(result.phone);
				$.ajax({type:"POST",url:"showBarCode",data:{'_token':jstToken,code:result.memID}}).done(function(res){
						document.getElementById("memBarCode").src=res.targetFilePath;
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

			<!-- Modal -->
<div id="viewMemberProfileModal" class="modal fade" role="dialog">
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

<div id="copyCardModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" align="right"><button  class="btn btn-danger" data-dismiss="modal">X</button></div>
				<div class="modal-body">

	<table class="table table-bordered">
	<tr><td colspan="2" align="center"><strong><span id="setBookName"></span></strong></td></tr>
	<tr><td rowspan="4" align="center"><!--<img src="backend.php?barCode=<?php //echo $copyID; ?>" alt="<?php //echo $copyID; ?>"/>--></td></tr>
	<tr><td><strong>Author:</strong> <span id="setBookAuthor"></span></td></tr>
	<tr><td><strong>Language:</strong> <span id="setBookLanguage"></span></td></tr>
	<tr><td align="center" id="copyIDsList"></td></tr>
	</table>
				</div>
			<div class="modal-footer" align="center"><button class="btn btn-sm btn-default" onclick="printDiv('copyIDsList')">Print</button></div>
		</div>
	</div>
</div>

<div class="panel panel-danger">
<div class="panel-heading" align="center">Search</div>
<div class="panel-body">
<table class="table table-bordered" id="taskpane" border="1">
<tr>
	<td colspan="3" align="center"><input class="form-control searchBookOrMember" size="10" id="searchBookInput" type="text" placeholder="Book Name" /><div id="BookSuggesstions" class="panel panel-info" style="display:none; position:absolute; background-color: #FF99FF; overflow-y:scroll;"></div></td></tr><tr>
	<td colspan="3" align="center"><input class="form-control searchBookOrMember" size="10" id="searchMemberInput" type="text" placeholder="Member Name" /><div id="MemberSuggesstions" class="panel panel-warning" style="display:none; position:absolute; background-color: #FF99FF; overflow-y:scroll;"></div></td></tr></table>
</div>
<!-- <div class="panel-footer" align="center">&nbsp;</div> -->
</div>

		</div>
		</div>
<div class="row">&nbsp;</div>
	<?php
?>