<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo Yii::app()->name; ?></title>

        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/css/redactor.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/css/other.css" rel="stylesheet">

        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/js/redactor.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/js/bootstrap-tooltip.js"></script>
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php
        Yii::app()->clientScript->registerScript('search', "
            $('.span3 form').live('change', function(){
                console.log('qwe');
                $.fn.yiiGridView.update('grid', {
                    data: $(this).serialize()
                });
            });
        ");
        ?>
    </head>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Reddot</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li>
                                <?php echo CHtml::link('Купленные', '/manager/default/index'); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Подтверждённые', '/manager/default/archive'); ?>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->homeUrl; ?>">Вернуться на сайт</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php echo $content; ?>
            <hr>
            <footer>
                <p>&copy; Reddot <?php echo date('Y'); ?></p>
            </footer>
        </div> <!-- /container -->
    </body>
</html>
