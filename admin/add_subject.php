<?php 
include('../config.php');
extract($_POST);
if(isset($save))
{
$que=mysqli_query($con,"select * from subject where subject_name='$subname'");	
$row=mysqli_num_rows($que);
	if($row)
	{
	$err="<font color='red'>This user already exists</font>";
	}
	else
	{
mysqli_query($con,"insert into subject values('','$subname','$s','$courseid')");	

	$err="<font color='blue'>Congrates Your Data Saved!!!</font>";
	}
	
}

?>

<script>
function showSemester(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}



xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("semester").innerHTML=xmlhttp.responseText;
}
}
//alert(str);
xmlhttp.open("GET","semester_ajax.php?id="+str,true);
xmlhttp.send();
}
</script>


<div class="row">
<div class="col-md-8">
<h2>Add Subject</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" cellspacing="5" cellpadding="5" class="table">
  <tr>
  <td colspan="2"><?php echo @$err; ?></td>
  </tr>
  <tr>
    <th width="237" scope="row">Select Department</th>
    <td width="213">
	<select name="courseid" id="courseid" onchange="showSemester(this.value)" class="form-control">
    <option disabled selected >Select Department</option>
	<?php
	$sub=mysqli_query($con,"select * from department");
	while($s=mysqli_fetch_array($sub))
	{
		$s_id=$s[0];
		echo "<option value='$s_id'>".$s[1]."</option>";
	}
	
	?>
    </select>
	</td>
  </tr>
	
 <tr>
    <th width="237" scope="row">Select Semester</th>
    <td width="213">
	<select name="s" id="semester" onchange="showsemester(this.value)" class="form-control"/>
    <option disabled selected >Select Semester</option>
    
    <?php
	$sub=mysqli_query($con,"select * from semester where department_id='".$res['department_id']."'");
	while($s=mysqli_fetch_array($sub))
	{
		$s_id=$s[0];
		echo "<option value='$s_id'>".$s[1]."</option>";
	}
	
	?>
	
	</select>
	
	
	</td>
  </tr>
  <tr>
    <th width="237" scope="row">Subject Name </th>
    <td width="213"><input type="text" name="subname" class="form-control"/></td>
  </tr>
  <tr>
    <th colspan="1" scope="row"></th>
	<td>
	<input type="submit" value="Add subject" name="save" class="btn btn-success" />
	
	<input type="reset" value="Reset" class="btn btn-success"/>
	</td>
  </tr>
  
  </table>
  </form>
  </div>
  </div>