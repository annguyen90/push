<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php include"../include/function.php" ?>
<?php
	//ktra thuoc tinh GET 
	if(isset($_GET['cid']) && filter_var($_GET['cid'] , FILTER_VALIDATE_INT , array('min_range'=>1))){
		$cid = $_GET['cid'];
	}else{
		redirect_to('admin/admin.php');
	}
	//kien tra thuoc tinh neu la post thuc hien lenh
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$loi = array();
		//kiem tra ten cua cat
		if(empty($_POST['category'])){
			$loi[] = 'category';
		}else{
			$category = mysqli_real_escape_string($dbc , strip_tags($_POST['category']));
		}
		//kiem tra position cua cat
		if(isset($_POST['position']) && filter_var($_POST['position'], FILTER_VALIDATE_INT, array('min_range'=>1))){
		
			$position = $_POST['position'];
		}else{
			$loi[] = 'position';
		}
		if(empty($loi)){
			//thuc hien chen them vao csdl
			$q = "UPDATE categories SET cat_name = '{$category}',position = '{$position}' WHERE cat_id = {$cid} LIMIT 1";
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
	$q = "SELECT cat_name , position FROM categories WHERE cat_id = {$cid}";
	$r = mysqli_query($dbc , $q) or die ("could not connect DB");
	if(mysqli_num_rows($r) ==1){
		//neu category ton tai xuat dl ra
		list($category,$position) = mysqli_fetch_array($r , MYSQLI_NUM);
	}else{
		$mesager = "<p > the category dose not exist</p>";
	}
?>
	<?php
		if(!empty($mesager)) echo $mesager;
	?>
	<h2>Edit categories :<?php if(isset($category)) echo $category ; ?> </h2>
    <form id="edit_cat" action="" method="post">
    	<fieldset>
        	<legend>Edit categories</legend>
            <div>
            	<label for="category">Categories name:
                	<?php
                    if(isset($loi) && in_array('category',$loi)){
						echo"please,fill in the category name";
					}
					?>
                </label>
                <input type="text" name="category" id="category" value='<?php if(isset($category)) echo $category ; ?>'/>
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
								if( isset($position) && ($position == $i))
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