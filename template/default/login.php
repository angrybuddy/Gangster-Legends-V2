<?php

    class template {
        
        public $pageMain =  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>{game_name} - {page}</title>
                <link rel="stylesheet/less" href="template/default/css/bootstrap.min.css">
                <link rel="stylesheet/less" href="template/default/less/bootstrap.less">
                <script src="template/default/js/less.js"></script>
            </head>
            
            <body>
            
                <div class="loginRow">
                    <div class="loginCol"></div>
                        <div class="loginHolder">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Login</h3>
                                </div>
                                <div class="panel-body">
                                    {game}
                                    <form action="?page=login" method="post">
                                        <input type="input" class="form-control" name="username" placeholder="Username" /><br />
                                        <input type="password" class="form-control" name="password" placeholder="Password" /><br />
                                        <input type="submit" value="Login" class="btn pull-right" />
                                        <input type="button" value="Register" class="btn btn-link pull-right" onClick="document.location = \'?page=register\';" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div class="loginCol"></div>
                </div>
            </body>
        </html>';
        
        
        public $success = '<div class="alert alert-success">{var1}</div>';
        public $error = '<div class="alert alert-danger">{var1}</div>';
        public $info = '<div class="alert alert-info">{var1}</div>';
        public $warning = '<div class="alert alert-warning">{var1}</div>';
    
    }

?>