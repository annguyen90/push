<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php include"../include/function.php" ?>
<div id="content">
<?php
	//kiem tra thuoc tinh get pid & pn 
	if(isset($_GET['pid'],$_GET['pn']) && filter_var($_GET['pid'] ,FILTER_VALIDATE_INT ,array('min_range'=>1))){
		$pid = $_GET['pid'];
		$pn = $_GET['pn'];
	}else{
	redirect_to('admin/view_page.php');
	}
	//cau lenh truy van
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['delete'])){
			$q = "DELETE FROM pages WHERE page_id = {$pid}";
			$r = mysqli_query($dbc ,$q);
			confirm_query($r ,$q);
			if(mysqli_affected_rows($dbc) ==1){
				echo "successfully";
			//}//End while 
		}else{
			echo "not successfully";
		}
	}else{
		echo"not connect db";
	}//MAIN IF	
}
?>
<form action="" method="post">
   	<fieldset>
    	<legend>Delete Pages</legend>
        <label for="delete">Are you sure?</label>
        <div>
        	<input type="radio" value="yes" name="delete" />Yes
            <input type="radio" value="no" name="delete" checked="checked"/>No
        </div>
        <div><input type="submit" name="submit" value="delete" onclick="return confirm('are you sure?')"/></div>
    </fieldset>
   </form> 
</div><!--End content--!>
<?php include"../include/footer.php" ?>