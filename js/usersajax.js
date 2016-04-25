<html>
	<head>
		<title>User List</title>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
		<script type="text/javascript" src="js/jquery.dform-1.1.0.js"></script>
		
		<script type="text/javascript" src='js/codebase/message.js'></script>
		<link rel="stylesheet" type="text/css" href="js/codebase/themes/message_default.css">
		<link rel="stylesheet" type="text/css" href="js/codebase/dhtmlx.css"/>
		<script type="text/javascript" src="js/codebase/dhtmlx.js"></script>
		
		<script type="text/javascript">
			var currentTableRow;
			var data = $('#myForm').serialize();
			
			/**
			*callback function for deleteRecord ajax call
			*/
			function deleteRecordComplete(xhr,status){
				if(status!="success"){
					alert("error while deleteing a page");
					return;
				}
				//divStatus.innerHTML=xhr.responseText;
				//wirte a code to delete the row from the HTML table
				
				// Get JSON String
				var JSONString = xhr.responseText;
				
				// Convert JSON String to JavaScript Object
				 var JSONObject = $.parseJSON(JSONString);
				 
				 // Dump all data of the Object in the console
				 //console.log(JSONObject);
				
				$('table#records_table tr#'+currentTableRow).remove();
				
				dhtmlx.message.expire = 10000; //time in milliseconds
				dhtmlx.message(JSONObject.username+' was successfully deleted');
			}
			
			/*function getCell(column, row) {
				var column = $('#' + column).index();
				var row = $('#' + row)
				return row.find('td').eq(column);
			}*/
			
			function confirmDeleteDialog(obj){
				dhtmlx.confirm({
					text:"Do you really want to delete this record?", 
					callback:function(result){
						if (result) {
							deleteRecord(obj);
						}
					}
				});
			}
			
			/**
			*makes an AJAX call to the server
			*/
			function deleteRecord(obj){
				//currentTableRow=obj.parentNode.parentNode.rowIndex;
				//alert(currentTableRow);
				$('#records_table tr').click(function() {
					currentTableRow = $(obj).attr('id'); // table row ID 
				});
				
				if(currentTableRow == null){
					return;
				}
				//currentUsercode = getCell('thUsercode', currentTableRow);
				
				var ajaxPageUrl="usersajax.php?cmd=1&uc="+currentTableRow;
				$.ajax(
					ajaxPageUrl,
					{async:true, complete:deleteRecordComplete}	
				);
			}
			
			
			/**
			*callback function for deleteRecord ajax call
			*/
			function showUsersRecordsComplete(xhr,status){
				if(status!="success"){
					alert("error while listing");
					return;
				}
				//wirte a code to add the row to the HTML table
				
				// Get JSON String
				var JSONString = xhr.responseText;
				
				// Convert JSON String to JavaScript Object
				 var JSONObject = $.parseJSON(JSONString);
				 
				// Dump all data of the Object in the console
				console.log(JSONObject);      
				
				// Access Object data
				//alert(JSONObject[0]["username"]); 
				if(JSONObject.result ==0){
					dhtmlx.message.expire = 10000; //time in milliseconds
					dhtmlx.message(JSONObject.message);
					return;
				}
				
				drawTable(JSONObject);
				
			}
			
			function drawTable(JSONObject) {
				var rows = [];
			    
				for (var key in JSONObject) {
					if (JSONObject.hasOwnProperty(key)) {
						//console.log(JSONObject[key]["username"] + ", " + JSONObject[key]["status"]);
						rows.push(
							drawRow(
								JSONObject[key]["user_id"], 
								JSONObject[key]["username"],
								JSONObject[key]["firstname"],
								JSONObject[key]["lastname"],
								JSONObject[key]["groupname"],
								JSONObject[key]["status"]
							)
						);
					}
				}
				
				$("#records_table").append(rows);
			}

			function drawRow(Usercode,Username,Firstname,Lastname,Usergroup,UserStatus) {
			
				var row = $("<tr id="+ Usercode + " />")
				row.append($("<td><strong>" + Usercode + "</strong></td>"));
				row.append($("<td><strong>" + Username + "</strong></td>"));
				row.append($("<td><strong>" + Firstname + "</strong></td>"));
				row.append($("<td><strong>" + Lastname + "</strong></td>"));
				row.append($("<td><strong>" + Usergroup + "</strong></td>"));
				row.append($("<td><strong>" + UserStatus + "</strong></td>"));
				row.append(
				$("<td><strong> <span class='clickspot' onclick='myFunction()'>edit</span> <span class='clickspot' onclick='confirmDeleteDialog(this)' >delete</span> <span class='clickspot' onclick='changeUserStatus(2,this)'>disable</span> <span class='clickspot' >reset</span></strong></td>"));
				
				return row;
			}
			
			function drawAddUserForm() {
				var rows = [];
				rows.push(drawAddUserFormElements());
				
				$("#myForm").append(rows);
			}
			
			function drawAddUserFormElements() {
				$(function(){

				  var items="";
				  $.getJSON("usersajax.php?cmd=0",function(data){

				    $.each(data,function(index,item) 
				    {
				      items+="<option value='"+item.usergroup_id+"'>"+item.groupname+"</option>";
				    });
				    $("#sel_usergroup").html(items); 
				  });

			});
				
				var row = $("<strong><span>Edit User</span></strong>");
				row.append($("<input type='hidden' value='4' name='cmd' /> "));
				row.append($("<label for='username'><span>Username <span class='required'>*</span></span><input type = 'text' name = 'username' value = '' placeholder='enter username'/></label> "));
				
				row.append($("<label for='password'><span>Password <span class='required'>*</span></span><input type = 'text' name = 'password' value = '' placeholder='enter password'/></label> "));
			
				row.append($("<label for='firstname'><span>Firstname <span class='required'>*</span></span><input type = 'text' name = 'firstname' value = ''placeholder='enter firstname'/></label>"));
			
				row.append($("<label for='lastname'><span>Lastname <span class='required'>*</span></span><input type = 'text' name = 'lastname' value = '' placeholder='enter lastname'/></label>"));
				
				row.append($("<label for='required'><span>Usergroup</span><select id='sel_usergroup' name='usergroup' class='select-field'> <option value = '-1'>-- select usergroup --</option></select></label>"));
				
				row.append($("<label for='status'><span>Account Status</span></label>"));
				row.append($("<br>"));
				row.append($("<input type = 'radio' name = 'status' value = 'ENABLED' /><span>Enabled</span><input type = 'radio' name = 'status' value = 'DISABLED' /><span>Disabled</span></label>"));
				
				row.append($("<label for='status'><span>Account Permission</span></label>"));
				row.append($("<br>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='View'  /><span>View</span>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='Add'  /><span>Add</span>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='Edit'  /><span>Edit</span>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='Delete'  /><span>Delete</span>"));
				
				row.append($("<label><span>&nbsp;</span><input type='submit' name='submit' value='Add' /></label>"));
				
				return row;
			}
			
			function drawEditUserForm(JSONObject) {
				var rows = [];
			    
				//for (var key in JSONObject) {
					//if (JSONObject.hasOwnProperty(key)) {
						//console.log(JSONObject[key]["username"] + ", " + JSONObject[key]["status"]);
						rows.push(
							drawEditFormElements(
								/*JSONObject[key]["user_id"], 
								JSONObject[key]["username"],
								JSONObject[key]["firstname"],
								JSONObject[key]["lastname"],
								JSONObject[key]["groupname"],
								JSONObject[key]["status"]*/
							)
						);
					//}
				//}
				
				$("#myForm").append(rows);
			}
			
			function drawEditUserFormElements(/*Usercode,Username,Firstname,Lastname,Usergroup,UserStatus*/) {
			
				var row = $("<label align='center'>Edit User</label>")
				row.append($("<br>"));
				row.append($("<label align='center'>Username</label><input type = 'text' name = 'username' value = ''/> "));
				row.append($("<br>"));
				row.append($("<label align='center'>Firstname</label><input type = 'text' name = 'firstname' value = ''/>"));
				row.append($("<br>"));
				row.append($("<label align='center'>Lastname</label><input type = 'text' name = 'lastname' value = ''/> "));
				row.append($("<br>"));
				row.append($("<label align='center'>Usergroup</label><select name = 'usergroup'> <option value = '-1'>-- select usergroup --</option></select>"));
				row.append($("<br>"));
				row.append($("<label align='center'>Account Status</label>"));
				row.append($("<br>"));
				row.append($("<input type = 'radio' name = 'status' value = 'ENABLED' checked='checked'/><label align='center'>Enabled</label><input type = 'radio' name = 'status' value = 'DISABLED' checked='checked'/><label align='center'>Disabled</label>"));
				row.append($("<br>"));
				row.append($("<label align='center'>Account Permission</label>"));
				row.append($("<br>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='View' checked /><label align='center'>View</label>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='Add' checked /><label align='center'>Add</label>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='Edit' checked /><label align='center'>Edit</label>"));
				row.append($("<input type ='checkbox' name ='permission[]' value='Delete' checked /><label align='center'>Delete</label>"));
				row.append($("<br>"));
				row.append($("<input type = 'submit' name='submit' value = 'Update' />"));
				
				return row;
			}
			
			function myFunction() {
				drawAddUserForm();
			}
			
			/**
			*makes an AJAX call to the server
			*/
			function showUsersRecords(){
				var ajaxPageUrl="usersajax.php?cmd=3";
				$.ajax(
					ajaxPageUrl,
					{async:true, complete:showUsersRecordsComplete}	
				);
			}
			
			/**
			* callback function for changeUserStatus method	
			*/
			function changeUserStatusComplete(xhr,status){
				if(status!="success"){
					divStatus.innerHTML="error sending request";
					return;
				}
				
				var obj=$.parseJSON(xhr.responseText);
				if(obj.result==0){
					divStatus.innerHTML=obj.message;	
				}else{
					
					divStatus.innerHTML="status changed";
						
				}
				
				currentObject=null;
			
			
			
			
			}
			/**
			*makes a AJAX call to server to change status of user
			*/
			function changeUserStatus(recordID,obj){
			//write a code to send request to AJAX page
				currentObject=obj;
				var theUrl="usersajax.php?cmd=2&uc="+recordID;
				$.ajax(theUrl,
					{async:true,complete:changeUserStatusComplete}
				);
			}
		</script>
	</head>
</html>
	