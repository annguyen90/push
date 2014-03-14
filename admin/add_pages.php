<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
    <?php
        // Kiem tra xem nguoi dung co duoc vao trang admin hay khong?
         
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') { // Gia tri tri ton tai, xu ly form.
        	$errors =  array();
			if(empty($_POST['page_name']) ){
				$errors[] = 'page_name';
			} else{
				$page_name = mysqli_real_escape_string($dbc,$_POST['page_name']);
			}
			 if(isset($_POST['category']) && filter_var($_POST['category'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
			 	$cat_name = $_POST['category'];
				}else{
					$errors[] = 'category';
				}
			if(isset($_POST['position']) && filter_var($_POST['category'],FILTER_VALIDATE_INT , array('min_range' => 1))){
				$position = $_POST['position'];
			}else {
				$error[] = 'position';
			}
			if(empty($_POST['page_content'])){
				$errors[] = 'connent';
			}else{
				$content = $_POST['page_content'];
			}
			if(empty($errors)){
				$q = "INSERT INTO pages(`user_id`, `cat_id`, `page_name`, `content`, `position`, `post_on`)
					VALUE (1,'{$cat_name}','{$page_name}','{$content}',$position,NOW())";
				$r = mysqli_query($dbc , $q) or die ("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
				if(mysqli_affected_rows($bdc == 1)){
					echo "the page add successfully";
				}else{
					echo "<p>cound not add page the bd</p>";
				}
			}
        } // END main IF submit condition
    ?>
   <div id="content">
   
  <form id="add_cat" action="" method="post">
  	<fieldset>
    	<legend>Add pages</legend>
        <div>
        	<label for="page_name">Pages<span>*</span>
            	
            </label>
            <input type="text" name="page_name" id="page_name" value="" size="20" maxlength="80" tabindex="1"/>
        </div>
        <div>
        	<label for="category">Category<span>*</span>
            	
            </label>
            <select name="category">
            	<option>select category</option>
               
            </select>
        </div>
        <div>
        	<label for="position">Position<span>*</span>
            	
            </label>
            <select name="position">
            	<option>select position</option>
               
            </select>
        </div>
        <div>
        	<label for="page_content">Content<span>*</span>
            	
            </label>
            <textarea name="page_content" cols="20" rows="10"></textarea>
        </div>
    
    </fieldset>
     <p><input type="submit" name="submit" value="Add page" /></p>
  </form>
 </div><!--end content-->       

<?php include"../include/footer.php" ?>