<?php
?>
<html><head><?php
require_once("include/functions.php");
offlinebootstrapandjqueryfiles();
$copyIDs=array();
?>
<script type="text/javascript">
	$(document).ready(function(e){
		var jstToken=$("#tokenID").val();
		$("#submit_book").click(function(e){
			var bookAddData = [];
			var jstToken=$("#tokenID").val();
			bookAddData[0]=$("#book_name").val();
			bookAddData[1]=$("#author").val();
			bookAddData[2]=$("#book_price").val();
			bookAddData[3]=$("#donor").val();
			bookAddData[4]=$("#donated_date").val();
			bookAddData[5]=$("#book_Language option:selected").val();
			bookAddData[6]=$("#book_category option:selected").val();
			bookAddData[7]=$("#noOfCopies").val();
			
			$.ajax({type:"POST",url:"addThisBook",data:{'_token':jstToken,submit_book:bookAddData}}).done(function(fromController){
				$("#copyCardModal").modal("show");
				$("#setBookName").html(fromController.bookName);
				$("#setBookAuthor").html(fromController.author);
				$("#setBookLanguage").html(fromController.bookLanguage);
				str=fromController.copyIDs;
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
						document.getElementById("imageTag"+codeOnly).src+=window.location.href+""+res.targetFilePath;
						});
				}
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
</div><!--ends-->
		<div class="panel panel-success">
			<div class="panel-heading" align="center">Add a Book</div>
			<div class="panel-body">
				<table class="table table-bordered">
<tr><td>Name:</td><td colspan="7"><input class="form-control" id="book_name" type="text"/></td></tr>
<tr><td>Author:</td><td colspan="7"><input class="form-control" id="author" type="text"/></td></tr>
<tr>
	<td>Language:</td>
	<td>
		<select class="form-control" id="book_Language">
		<option value="">---</option>
		<option value="Tamil">Tamil</option>
		<option value="English">English</option>
		<option value="sinhala">Sinhala</option>
		</select>
	</td>
	<td>Category:</td>
	<td colspan="3">
		<select class="form-control" id="book_category">
		<option value="">---</option>
		<option value="Arts">Arts</option>
		<option value="Commerce">Commerce</option>
		<option value="Science">Science</option>
		<option value="I.T">I.T</option>
		<option value="Novels">Novels</option>
		<option value="Journals">Journals</option>
		<option value="Magazines">Magazines</option>
		<option value="Dictionaries">Dictionaries</option>
		<option value="Atlas">Atlas</option>
		</select>
	</td><td>Price&nbsp;(Rs.):</td><td colspan="2"><input class="form-control" id="book_price" type="text"/></td></tr>
<tr><td>No. of Copies:</td><td colspan="7"><input id="noOfCopies" class="form-control" type="number"/></td></tr>
<tr><td>Donor & Date: </td><td colspan="6"><input class="form-control" id="donor" type="text"/></td><td><input class="form-control" value="<?php echo date('Y-m-d'); ?>" type="date" id="donated_date"/></td></tr>
</table>
			</div>
			<div class="panel-footer" align="center"><button class="btn btn-success" id="submit_book">Add Book</button></div>
		</div>

		</div>
		</div>
<div class="row">&nbsp;</div>