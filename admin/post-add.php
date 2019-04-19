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

  if($Q_METHOD == 'POST'){  //增加
      //validate();
      $id = uniqid();
      $title = $_POST['title'];
      $content = $_POST['content'];
      $alias_name = isset($_POST['alias_name']) ? $_POST['alias_name'] : '';
      
      // $pic_name = $_FILES['pic']['name'];
      // $pic_extension = pathinfo($pic_name,PATHINFO_EXTENSION);
     
      $pic_path = "../static/upload/"  . $id . '-' . $_FILES['pic']['name'];
      move_uploaded_file($_FILES['pic']['tmp_name'], $pic_path);
      $catagory_id = $_POST['catagory_id'];
      $status = $_POST['status'];
      $create_date = date("Y-m-d H:i:s");
      $last_modify_date = date("Y-m-d H:i:s");
      $user_id = $current_user['id'];
      $user_name = $current_user['name'];
      var_dump($current_user);
      // TODO : 数据持久化
      $sql = "insert into posts(id,title,content,alias_name,pic,catagory_id,`status`,create_date,last_modify_date,user_id,user_name) 
              VALUES('" . $id . "','" . $title . "','" . $content . "','" . $alias_name . "','" . $pic_path . "','" . $catagory_id . "','" . $status . "','" . $create_date . "','" . $last_modify_date . "','" . $user_id . "','" . $user_name . "')";
      // var_dump($sql);
      $dbResult = insert($sql);
      $GLOBAL['message']  = $dbResult->getMessage();
      
    }
  if($Q_METHOD == 'GET'){
    // 编辑
    // $sql = 'select * from posts where id = "5cb7aaaf1fdc4"';
    // $result = query($sql);
    // if($result->getCount() !== 0){
    //   $current_post = $result->getData()
    // }
  }
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
                          <input type="text" id="title" name="title" class="form-control input-lg" placeholder="标题" value="抑郁症，你需要了解的求助常识"/>
                      </div>
                      <div class="form-group">
                          <label for="content">内容</label>
                          <textarea class="form-control input-lg" id="content" name="content" id="" cols="30" rows="10" placeholder="内容">
                            最近《奇葩大会》有一期关于躁郁症的分享，引起了很多关注。演讲者的个人经验让人动容，听完也很振奋。但这种振奋，却不一定能为别的患者带来帮助。因为每个人的经验不相同。我想起做过的一场关于抑郁症的讲座，针对「普通人遇到这种问题，应该找谁求助」，介绍了一些更普适的经验。说常识也都是常识。不过，目前大家对精神卫生服务的认识还存在一些混乱，这些常识也有一定的传播价值。希望能为抑郁症和躁郁症患者们提供一点实用的信息。
                          </textarea>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="alias_name">别名</label>
                          <input type="text" id="alias_name" name="alias_name" class="form-control" value="抑郁症"/>
                          <span>https://zce.me/post/slug</span>
                      </div>
                      <div class="form-group">
                          <label for="pic">特色图像</label>
                          <input type="file" class="form-control" id="pic" name="pic" />
                      </div>
                      <div class="form-group">
                        <label for="catagory_id">特色分类</label>
                        <select class="form-control" name="catagory_id" id="catagory_id">
                            <option value="1">生活</option>
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="create_date">发布时间</label>
                          <input type="date" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label for="status">状态</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1">草稿</option>
                        </select>
                      </div>
                      <button class="btn btn-primary">发布</button>
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