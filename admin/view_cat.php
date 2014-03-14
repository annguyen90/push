<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php include"../include/function.php" ?>
<div id="content">
	
	<h2>Manager Category</h2>
    <table>
    	<thead>
        	<tr>
            	<th><a href="view_cat.php?sort=cat">Category</a></th>
                <th><a href="view_cat.php?sort=pos">Position</a></th>
                <th><a href="view_cat.php?sort=by">Position_by</a></th>
                <th>Edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
			//xet phuon thuc get
			if(isset($_GET['sort'])){
				switch($_GET['sort']){
					case 'cat' :
					$order_by = 'cat_name';
					break ;
					case 'pos' :
					$order_by = 'position';
					break;
					case 'by' :
					$order_by = 'name';
					break ;
					
					default :
					$order_by = 'position';
				}//end switch
			}else
				$order_by = 'position';
			//cau truy van csdl
			$q = "SELECT c.cat_id,c.cat_name,c.position , c.user_id ,CONCAT_WS('',first_name,last_name) AS name ";
			$q .=" FROM categories AS c ";
			$q .= " JOIN users AS u ";
			$q .=" USING(user_id) ";
			$q .=" ORDER BY {$order_by} ASC ";
			$r = mysqli_query($dbc ,$q);
			confirm_query($r ,$q);
				while($cats = mysqli_fetch_array($r , MYSQLI_ASSOC)){
					echo "
					<tr>
						<td>{$cats['cat_name']}</td>
						<td>{$cats['position']}</td>
						<td>{$cats['name']}</td>
						<td><a href='edit_cat.php?cid={$cats['cat_id']}' class='edit'>Edit</a></td>
						<td><a href='delete_cat.php?cid={$cats['cat_id']}& cat_name={$cats['cat_name']}' class='delete'>Delete</a></td>
					</tr>
					
					";
				}
		?>
        	
        </tbody>
    </table>
</div><!--End content--!>
<?php include"../include/footer.php" ?>