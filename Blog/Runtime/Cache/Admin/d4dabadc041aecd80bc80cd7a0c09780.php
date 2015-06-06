<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>Admin | KyoMini Blog</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <link rel="stylesheet" href="/blog/Blog/Admin/View/Public/Css/bootstrap.css">
     <link rel="stylesheet" href="/blog/Blog/Admin/View/Public/Css/admin.css">
     <link rel="shortcut icon" href="favicon.ico" >
            <!--[if lt IE 9]>
               <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
               <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
             <![endif]-->
</head>



<body>
    <?php  $db=M('Admin'); $admin=$db->where('id=1')->getField('nickname'); ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo U('/Admin');?>"><?php echo (L("_Admin_Logo_")); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo U('/Admin');?>"><?php echo (L("Survey")); ?></a></li>
            <li><a href="<?php echo U('/Admin/Article/Article_add');?>"><?php echo (L("Write")); ?></a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (L("Manage")); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo U('/Admin/Article ');?>"><?php echo (L("Article")); ?></a></li>
                    <li><a href="<?php echo U('/Admin/Category');?>"><?php echo (L("Classify")); ?></a></li>
                    <li><a href="<?php echo U('/Admin/Comment ');?>"><?php echo (L("Review")); ?></a></li>
                    <li><a href="<?php echo U('/Admin/Page');?>"><?php echo (L("One_page")); ?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo U('/Admin/Menu');?>"><?php echo (L("Navigation")); ?></a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (L("Config")); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo U('/Admin/Settings');?>"><?php echo (L("Basic_config")); ?></a></li>
                    <li><a href="<?php echo U('/Admin/Picture');?>"><?php echo (L("Picture")); ?></a></li>
                    <li><a href="<?php echo U('/Admin/Template');?>"><?php echo (L("Surface")); ?></a></li>
                    <li><a href="<?php echo U('/Admin/Lang');?>?l=<?php echo (C("LANG_LIST")); ?>"><?php echo (L("_Language_")); ?></a></li>
                     

                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (L("hi")); ?>，<?php echo ($admin); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/blog"><?php echo (L("Into_web")); ?></a></li>
                    <li><a href="<?php echo U('Index/cache_del');?>"><?php echo (L("Update_cache")); ?></a></li>
                    <li id="aboutus_menu"><a href="<?php echo U('/Admin/About');?>"><?php echo (L("About")); ?></a></li>
                    <li class="divider"></li>
                    <li><a href="#" data-toggle="modal" data-target="#password"><?php echo (L("Set_Password")); ?></a></li>
                </ul>
            </li>
            <li><a href="<?php echo U('Index/login_out');?>"><?php echo (L("Sign_out")); ?></a>
            </li>
        </ul>
    </div>
</nav>
 <span id="result"></span>
    <div class="container">
        <div class="page-header">
            <h3><?php echo (L("_Language_")); ?></h3>
        </div>
        <?php if(empty($lang_setting)): ?><h3> 没有设置项</h3>

            <?php else: ?>
                <form class="form-horizontal" role="form" method="post" action="<?php echo U('Update');?>" id="forms">

                    <div class="MiniBox2">

                        <?php if(is_array($lang_setting)): foreach($lang_setting as $k=>$vo): if($vo["type"] == 'select'): ?><label for=""><?php echo L($vo['code']); echo (L("lang_Modify")); ?></label>
                                <select class="form-control miniinput2" name="<?php echo ($vo["code"]); ?>" selected="<?php echo (C("DEFAULT_LANG")); ?>">

                                    <?php if(is_array($vo["store_range"])): foreach($vo["store_range"] as $key=>$vo1): ?><option value="<?php echo ($vo1); ?>"><?php echo ($vo1); ?></option><?php endforeach; endif; ?>
                                </select><?php endif; endforeach; endif; ?>

                        <button type="submit" class="btn btn-info "><?php echo (L("_Safe_")); echo (L("_Language_")); ?></button>
                        <a class="btn btn-info" href="<?php echo U('/Admin/Lang');?>?l=<?php echo (C("DEFAULT_LANG")); ?>">
                            <?php echo (L("_Change_")); ?> <?php echo (C("DEFAULT_LANG")); ?></a>
                    </div>
                </form><?php endif; ?>



        <div class="footer">
        <p>&copy; 2014 <a href="#">www.kyomini.com</a> All Rights Reserved.</p>
        <span>KyoMini V0.1</span>
</div>
<script src="/blog/Blog/Admin/View/Public/Js/jquery-1.11.0.min.js"></script> 
<script src="/blog/Blog/Admin/View/Public/Js/bootstrap.min.js"></script> 
  <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
      </div>
      <form method="post" action="/blog/index.php/Admin/Index/update">
      <div class="modal-body">
     
   
   
   
   
   
   
   
   

   
   
   <table width="100%">
        	<tr>
            	<td width="33%" align="right"><span class="cName">登陆帐号</span></td>
                <td width="67%" style="height:65px;
                text-align:left"><?php echo ($user["name"]); ?>
                
                
                </td>
            </tr>
            <tr>
            	<td align="right"><span class="cName">修改您称</span></td>
                <td>      <input type="text" class="form-control miniinput2" name="nickname" value="<?php echo ($user["nickname"]); ?>">
</td>
            </tr>
            <tr>
            	<td align="right"><span class="cName">修改密码</span></td>
                <td>      <input type="text" class="form-control miniinput2" name="password">
</td>
            </tr>
        </table>


      </div>
      <div class="modal-footer">
    <input type="hidden" name="id" value="<?php echo ($user["id"]); ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">修改</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  
    
    
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    </div>
    <script src="/blog/Blog/Admin/View/Public/Js/jquery.form.js"></script>
    <script language="javascript" type="text/javascript">
        $('#forms').ajaxForm({
            success: function(data) {
                var Mini = "";
                if (data.status == 1) {
                    Mini = "<div class='alert alert-success'>" + data.info + "</div>";
                } else {
                    Mini = "<div class='alert alert-danger'>" + data.info + "</div>";
                }
                $('#result').html(Mini).show();
                //location = location;
                setTimeout(function() {
                    if(data.url){
                        location = location;
                    }
                    $('#result').html('').fadeOut();
                }, 3000);
            },
            dataType: 'json'
        });
    </script>
</body>

</html>