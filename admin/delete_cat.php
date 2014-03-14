<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php include"../include/function.php" ?>
<div id="content">
	<?php
		if(isset($_GET['cid'],$_GET['cat_name']) && filter_var($_GET['cid'], FILTER_VALIDATE_INT, array('min_range' =>1))) {
			$cid = $_GET['cid'];
			$cat_name = $_GET['cat_name'];
			if($_SERVER['REQUEST_METHOD']=='POST'){
				if(isset($_POST['delete']) && ($_POST['delete'] == 'yes')){
					$q = "DELETE FROM categories WHERE cat_id = {$cid} LIMIT 1";
					$r = mysqli_query($dbc , $q) or die ("asjcsavc");
					if(mysqli_affected_rows($dbc) ==1){
						$messager = "<p>successfully</p>";
					}else{
						$messager = "<p>not successfully</p>";
					}
				}else{
					echo "<p>not delete</p>";
				}
			
			}//End if request method = post
    }else {
        // Neu CID va cat_name khong ton tai, hoac khong dung dinh dang mong muon
        //redirect_to('admin/view_cat.php');
		echo "sai";
}
	?> 
   <h2>Delete Category</h2>
   <?php if(isset($messager)) echo $messager ; ?>
   <form action="" method="post">
   	<fieldset>
    	<legend>Delete category</legend>
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