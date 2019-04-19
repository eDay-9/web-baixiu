<?php 
  require_once("../config.php");
  require_once("inc/common.php");
  
  function validate(){
      if(!isset($_POST['title'])) return ;
      if(!isset($_POST['content'])) return ;
      if(!isset($_POST['catagory_id'])) return;
      if(!isset($_POST['status'])) return;
      if(!isset($_POST['create_date'])) return;
  }
  $current_user = $_SESSION['user'];
  $Q_METHOD = $_SERVER['REQUEST_METHOD'];

  if($Q_METHOD == 'POST'){  //修改
    
  }
  if($Q_METHOD == 'GET'){
    // 编辑
    $id = isset($_GET['id']) ?  $_GET['id'] : ''; 
    $sql = 'select * from posts where id = "' . $id . '"';
    $result = query($sql);
    if($result->getCount() !== 0){
      $current_post = $result->getData()[0];
    }
  }
  // var_dump(date('y-m-d',strtotime('2019-01-01')));
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <?php require_once('inc/header.php'); ?>
</head>
<body>
  <div id="post-add" class="main">
    <!-- 导航 strat -->
    <nav class="navbar"></nav>
    <!-- 导航 end -->
    <!-- 主要内容 start -->
    <div class="container-fluid">
        <div class="page-title">
             <h1>写文章</h1>
        </div>
        <?php if($Q_METHOD == 'POST' ) : ?>
            <div class="alert alert-danger">
              <strong> <?php echo $GLOBAL['message']; ?></strong> 
            </div>
        <?php endif ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" autocomplete="on">
             <div class="row">
                  <div class="col-md-8">
                      <div class="form-group">
                          <label for="title">标题</label>
                          <input type="text" id="title" name="title" class="form-control input-lg" placeholder="标题" value="<?php echo isset($current_post['title']) ? $current_post['title'] : '' ?>"/>
                      </div>
                      <div class="form-group">
                          <label for="content">内容</label>
                          <textarea class="form-control input-lg" id="content" name="content" id="" cols="30" rows="10" placeholder="内容">
                            <?php echo isset($current_post['content']) ? $current_post['content'] : ''; ?>
                          </textarea>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="alias_name">别名</label>
                          <input type="text" id="alias_name" name="alias_name" class="form-control" value="<?php echo isset($current_post['alias_name']) ? $current_post['alias_name'] : ''; ?>"/>
                          <span>https://zce.me/post/slug</span>
                      </div>
                      <div class="form-group">
                          <label for="pic">特色图像</label>
                          <input type="file" class="form-control" id="pic" name="pic" />
                      </div>
                      <div class="form-group">
                        <label for="catagory_id">特色分类</label>
                        <select class="form-control" name="catagory_id" id="catagory_id">
                            <option value="1" <?php echo (isset($current_post['catagory_id']) && $current_post['catagory_id'] == 1) ? 'checked' : ''; ?>>生活</option>
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="create_date">发布时间</label>
                         <!--  <input type="date" value="<?php echo isset($current_post['create_date']) ? $current_post['create_date'] : ''; ?>" class="form-control" /> -->
                         <input type="date" value="<?php echo date('Y-m-d',strtotime($current_post['create_date'])); ?>" class="form-control" readonly/>
                      </div>
                      <div class="form-group">
                        <label for="status">状态</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php echo (isset($current_post['status']) && $current_post['status'] == 1) ? 'checked' : ''; ?>>草稿</option>
                        </select>
                      </div>
                      <button class="btn btn-primary">修改</button>
                  </div>  

             </div>
        </form>
    </div>
    <!-- 主要内容 end -->
  </div>
  <!-- 侧边菜单 start -->
  <div class="aside"></div>
  <!-- 侧边菜单 end -->
  <?php require_once('inc/footer.php'); ?>
  <script src="../static/assets/js/admin.js"></script>
</body>
</html>