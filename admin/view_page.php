<?php include"../include/head.php" ?>
<?php include"../include/mysqli_connect.php" ?>
<?php include"../include/siderbar-admin.php" ?>
<?php include"../include/function.php" ?>
<div id="content">
<h2>Manage Pages</h2>
<table>
	<thead>
		<tr>
			<th><a href="view_pages.php?sort=page">Pages</a></th>
			<th><a href="view_pages.php?sort=on">Posted on</th>
			<th><a href="view_pages.php?sort=by">Posted by</th>
            <th>Content</th>
            <th>Edit</th>
            <th>Delete</th>
		</tr>
	</thead>
	<tbody>
    <?php
		if(isset($_GET['sort'])){
			switch($_GET['sort']){
				case 'page'	:
				$order_by = 'page_name';
				break;
				case 'on' :
				$order_by = 'date';
				break;
				case 'by':
				$order_by = 'name';
				break;
				default :
				$order_by = 'date';
			}//End switch
		}else{
			$order_by = 'date';
		}//End isset sort
		$q = "SELECT p.page_id , p.page_name ,DATE_FORMAT(p.post_on ,'%b %d %Y') AS date ,CONCAT_WS('',first_name,last_name) AS name ,p.content ";
		$q .=" FROM pages AS p JOIN users AS u USING(user_id) ";
		$q .=" ORDER BY {$order_by} ASC ";
		$r = mysqli_query($dbc , $q) or die ("hsikfhas");
		while($pages = mysqli_fetch_array($r ,MYSQLI_ASSOC)){
			echo"
				<tr>
					<td>{$pages['page_name']}</td>
					<td>{$pages['date']}</td>
					<td>{$pages['name']}</td>
					<td>".the_excerpt($pages['content'])."</td>
					<td><a class='edit' href='edit_page.php?pid={$pages['page_id']}'>Edit</a></td>
					<td><a class='delete' href='delete_page.php?pid={$pages['page_id']}&pn={$pages['page_name']}'>Delete</a></td>
				</tr>  	
			";
		}//End while
	?>
           
	</tbody>
</table>
</div><!--end content-->
<?php include('../include/footer.php'); ?>