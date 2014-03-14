<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$loi = array();
		if(empty($_POST['category'])){
			$loi[] = 'category';
		}else{
			$category = mysqli_real_escape_string($dbc,strip_tags( $_POST['category']));
		}
		if(isset($_POST['position'])){
			$position = $_POST['position'];
		}else{
			$loi[] = 'position';
		}
		if(empty($loi)){
			//thuc hien chen them vao csdl
			$q = "INSERT INTO `categories`( `user_id`, `cat_name`, `position`) VALUES (1,'{$category}','{$position}')";
			$r = mysqli_query($dbc , $q)or die("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
			if(mysqli_affected_rows($dbc)==1){
				$mesager = "succssefuly";
			}else{
				$mesager = "no succssefuly";
			}
		}//End if insert database
	}//	End maind if subit
	
?>
<div id="content">
	<?php
		if(!empty($mesager)) echo $mesager;
	?>
	<h2>Create a categories</h2>
    <form id="cat_demo" action="" method="post">
    	<fieldset>
        	<legend>Add categories</legend>
            <div>
            	<label for="category">Categories name:
                	<?php
                    if(isset($loi) && in_array('category',$loi)){
						echo"please,fill in the category name";
					}
					?>
                </label>
                <input type="text" name="category" id="category" value='<?php if(isset($_POST['category'])) echo strip_tags($_POST['category']); ?>'/>
            </div>
            <div>
            	<label for="position">Position
                	<?php
						if(isset($loi) && in_array('position',$loi)){
							echo"please , fill in the position";
						}
					?>
                </label>
                <select name="position">
                	<?php
						$q = "SELECT COUNT( cat_id )AS count FROM  `categories`";
						$r = mysqli_query( $dbc , $q) or die ("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
						if(mysqli_num_rows($r) ==1){
							list($num) = mysqli_fetch_array($r , MYSQLI_NUM);
							for($i = 1;$i <=$num+1; $i++){
							//vong lap for cho potion
								echo "<option value='{$i}'";
								if( isset($_POST['position']) && ($_POST['position'] == $i))
										echo "selected = 'selected'";
								echo ">".$i."</option>";
							}
						} 
					?>
                	
                </select>
            </div>
        </fieldset>
        <p><input type="submit" name="submit" value="Add category"/></p>
    </form>
</div><!--End content-->


<?php include"../include/footer.php" ?>