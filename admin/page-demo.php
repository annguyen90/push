<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$loi = array();
		if(empty($_POST['name_page'])){
			$loi[] = 'name_page';
		}else{
			$name_page = $_POST['name_page'];
		}
		if(isset($_POST['category'])){
			$category = $_POST['category'];
		}else{
			$loi[] = 'category';
		}
		if(isset($_POST['position'])){
			$position = $_POST['position'];
		}else{
			$loi[] = 'position';
		}
		if(empty($_POST['content'])){
			$loi[] = 'content';
		}else{
			$content = $_POST['content'];
		}
		if(empty($loi)){
			//neu ko xay ra loi
			$q = "INSERT INTO `pages`(`user_id`, `cat_id`, `page_name`, `content`, `position`, `post_on`) VALUES (1,'{$category}','{$name_page}','{$content}','{$position}',NOW())";
			$r = mysqli_query($dbc , $q)or die("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
			if(mysqli_affected_rows($dbc) ==1){
				$thongbao = " thanh cong";
			}else{
				$thongbao = "ko thanh cong";
			}
		}// End if insert database
	}//End main IF sumbit
?>
<div id="content">
<?php 
	if(!empty($thongbao)) echo $thongbao;
?>
	<h2>Add page</h2>
    <form name="page" method="post">
    	<fieldset>
        	<legend>Add Page</legend>
            <div>
            	<label for="name_page">Page
                	<?php
						if( isset($loi)&& in_array('name_page',$loi)){
							echo "please,fill in the name page";
						}
					?>
                </label>
                <input type="text" name="name_page"  value="<?php if(isset($_POST['name_page'])) echo strip_tags($_POST['name_page']); ?>"/>
            </div>
            <div>
            	<label for="category">Category :
                	<?php
						if(isset($loi) && in_array('category',$loi))
						echo "please,fill in the category";
					?>
                </label>
                <select name="category"  >
                	<?php
						$q = "SELECT `cat_id` , `cat_name` FROM `categories` ORDER BY position ASC";
						$r = mysqli_query($dbc ,$q) or die("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
						if(mysqli_num_rows($r) > 0){
						while ($cat = mysqli_fetch_array($r ,MYSQLI_NUM )){
							echo "<option value='{$cat[0]}'>".$cat[1]."</option>";
							if(isset($_POST['category']) && $_POST['category'] == $cat[0])
							echo "selected = 'selected'";
							echo ">".$cat[1]."</option>";
						}
					}
					?>
                	<option value=""></option>
                </select>
            </div>
            <div>
            	<label for="position">Position
                	<?php
						if(isset($loi) && in_array('position' , $loi))
						echo "please,fill in the position";
					?>
                </label>
                <select name="position">
                	<?php
						$q = "SELECT count( page_id ) AS COUNT FROM `pages`";
						$r = mysqli_query($dbc , $q) or die ("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
						if(mysqli_num_rows($r) == 1){
							list($num) = mysqli_fetch_array($r , MYSQLI_NUM);
						
							for($i = 1; $i<=$num+1; $i++){
								echo "<option value='{$i}'";
								if(isset($_POST['position']) && $_POST['position'] == $i)
								echo "selected = 'selected'";
								echo ">".$i."</option>";
							}
						}
					?>
                </select>
            </div>
            <div>
            	<label for="content">Content
                	<?php
						if(isset($loi) && in_array('content' ,$loi))
						echo "please,fill in the content";
					?>
                </label>
                <textarea  name="content" cols="15" rows="5"  tabindex="2" >
                	<?php if(isset($_POST['content'])) echo htmlentities($_POST['content'] , ENT_COMPAT ,'UTF-8');	?>
                </textarea>
            </div>
        </fieldset>	
        <p><input type="submit" value="Add page" name="submit" /></p>
    </form>
</div><!--End content-->

<?php include"../include/footer.php" ?>