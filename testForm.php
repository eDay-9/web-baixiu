<?php 
	// echo json_encode($_FILES['img']);
	// var_dump($_FILES);
	// move_uploaded_file($_FILES['img']['tmp_name'], "./static/upload/1.jpg");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>testForm</title>
	<link rel="stylesheet" href="static/verdors/bootstraps/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
			<div class="form-group">
				<label for="username">名称</label>
				<input type="text" class="form-control" name="username" />
			</div>
			<div class="form-group">
				<lable for="password">密码</lable>
				<input type="text" class="form-control" name="password" />
			</div>
			<div class="form-group">
				<input type="file"  id="img" name="img" class="form-control" />
			</div>
			<div class="form-group">
				<input type="checkbox" id="checkAll" /> 全选中
				<input type="checkbox" id="disCheckAll" /> 全部取消
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
				<input type="checkbox" name="id" id="favorite" />
			</div>
			<button class="btn btn-primary">提交</button>
		</form>
	</div>
	<script src="static/verdors/jQuery/jquery-1.12.4.js"></script>
	<script>
		window.onload = function(){
			// $("#favorite").on('click',function(){
			// 	// var checked = $(this).attr("checked");
			// 	// alert(checked);
			// 	alert();
			// });

			$("#checkAll").on('click',function(){
				alert(true);
				alert($(this));
				alert($(this).is(':checked'));

				if($(this).is(':checked')){
					$('input[name="id"]').prop('checked',true);
				} else{
					$('input[name="id"]').prop('checked',false);
				}
			});
		}
	</script>
</body>
</html>