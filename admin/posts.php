<?php 
	require_once('../config.php');
	require_once('inc/common.php');


	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$size = 5;
	$offset = ($page - 1) * $size; 
	// $sql = "select * from posts limit " . $offset . "," . $size ;
	$where = '';
	if(isset($_GET['catagory_id'])){
		$where .= 'catagory_id = ' . $_GET['catagory_id']; 
	}
	if(isset($_GET['status'])){
		$where .= 'status = ' . $_GET['status'];
	}
	// $catagory_id = isset($_GET['catagory_id']) ? $_GET['catagory_id'] : null;

	// $status = isset($_GET['status']) ? $_GET['status'] : null;
	var_dump($where);
	$where = empty($where) ? '' : ' where ' . $where;
	$sql = 'select * from posts ' . $where .  ' limit ' . $offset . ' , ' . $size;
	$result = query($sql);
	// var_dump($result);
	// if($result->getMessage !== DB_STATUS_SQL_SUCCESS) $result->setData(array());
	$result_count = $result->getMessage() == DB_STATUS_SQL_SUCCESS ? $result->getCount() : 0;

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index >> Admin</title>
	<?php require_once('inc/header.php'); ?>
</head>
<body>
	<!-- 侧边 -->
	<div class="aside">
	</div>
	<!-- 版心 -->
	<div id="posts" class="main">
		<!-- 导航栏 -->
		<div class="navbar">
		</div>
		<!-- 内容 -->
		<div class="container-fluid">
			<div class="page-title">
				<h1>所有文章</h1>
			</div>
			<div class="row page-action">
				<div class="col-md-5">
					<form class="form-inline">
						<label for="catagory_id" class="sr-only">分类</label>
						<select name="catagory_id" id="catagory_id" class="form-control input-sm" >
						   	<option value="1">生活</option>
						</select>
						<label for="status" class="sr-only">Password</label>
						<select name="status" id="status" class="form-control input-sm">
						   <option value="1">草稿</option>
						</select>
						<button  class="btn btn-default btn-sm">筛选</button>
					</form>
				</div>
				<div class="col-md-1">
					<button class="btn btn-danger btn-sm">批量删除</button>
				</div>
				<div class="col-md-6">
					 <ul class="pagination pull-right">
					    <li class="page-item"><a class="page-link" href="#" data-value="上一页"><<</a></li>
					    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li> -->
					    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li> -->
					    <!-- <li class="page-item"><a class="page-link" href="#">3</a></li> -->
					    <?php for ($i=0; $i < $result_count ; $i++) {  ?>
							<li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?> ?page=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a></li>
					    <?php  }?>
					    <li class="page-item"><a class="page-link" href="#" data-value="下一页">>></a></li>
					 </ul>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover">
				  <thead>
				    <tr>
				      <th scope="row" class="text-center" width="40px">
				      	<input  type="checkbox"/>
				      </th>
				      <th>标题</th>
				      <th>作者</th>
				      <th>分类</th>
				      <th>操作</th>
				    </tr>
				  </thead>
				  <tbody>
				      <?php foreach ($result->getData() as $item ) : ?>
							<tr>
						      <td scope="row" class="text-center" width="40px">
						      	<input n data-id="<?php echo $item['id'] ?>" type="checkbox"/>
						      </td>
						      <td><?php echo $item['title']; ?></td>
						      <td><?php echo $item['user_name']; ?></td>
						      <td><?php echo $item['catagory_id']; ?></td>
						      <td>
						      	<a href="/admin/post-edit.php?id=<?php echo $item['id'] ?>" class="btn btn-default btn-xs">编辑</a>
						      	<a href="/admin/post-delete.php?id=<?php echo $item['id'] ?>" class="btn btn-danger btn-xs">删除</a>
						      </td>
						    </tr>
				      <?php endforeach	?>
				</table>
		</div>
	</div>
	
	<?php require_once('inc/footer.php'); ?>
	<script src="../static/assets/js/admin.js"></script>
	<script>
		$("#posts table th input:checkbox").on("change",function(){
			var checked = $(this).is(":checked");
			$("#posts table td input:checkbox").prop("checked",checked);
		});
		var ids = [];
		$('#posts tbody td input:checkbox').on('change',function(){
			var thisId = $(this).data('id');
			$(this).is(':checked') ? ids.push(thisId) : ids.splice(ids.indexOf(thisId),1);
			
			// alert($ids.length);
			var input_ids = $("#posts table th input:checkbox");
			ids.length > 0 ?  input_ids.prop('checked',true) : input_ids.prop('checked',false);
			// $(this).prop('href','/admin/');
		});
	</script>
</body>
</html>