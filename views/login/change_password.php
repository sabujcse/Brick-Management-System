<script>
function myFunction() {
    var pass1 = document.getElementById("new_pass").value;
    var pass2 = document.getElementById("con_new_pass").value;
    var ok = true;
    if (pass1 != pass2) {
        alert("Password Doesn't Match !");
        document.getElementById("new_pass").style.borderColor = "#E34234";
        document.getElementById("con_new_pass").style.borderColor = "#E34234";
        ok = false;
    }
    return ok;
}
</script>
<form id="add" action="<?php echo base_url(); ?>login/change_password" method="post" onsubmit="return myFunction()">
<table width="70%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
    <thead>
        <tr>
            <th scope="col" style="width:25%; text-align:right; vertical-align:top;">Current Password</th>
			<th><input class="smallInput" type="password" required="1" name="current_pass" id="current_pass"></th>
            
        </tr>
		<tr>
            <th  scope="col" style="width:25%; text-align:right; vertical-align:top;">New Password</th>
			<th><input class="smallInput" type="password" required="1" name="new_pass" id="new_pass"></th>         
        </tr>
		<tr>
            <th  scope="col" style="width:25%; text-align:right; vertical-align:top;">Confirm New Password</th>
			<th><input class="smallInput" type="password" required="1" name="con_new_pass" id="con_new_pass"></th>         
        </tr>
		
		<tr><td></td><td><input class="smallInput" type="hidden" required="1" name="user_id" id="user_id" value="<?php echo $user_id;?>"> 
		<input type="submit" class="submit" value="Change">
            </td></tr>
    </thead>
	</table>
</form>
<br />
<div class="clear"></div><br />
