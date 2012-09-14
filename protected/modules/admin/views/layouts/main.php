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

        <!--
            <script src="../assets/js/jquery.js"></script>
            <script src="../assets/js/bootstrap-transition.js"></script>
            <script src="../assets/js/bootstrap-alert.js"></script>
            <script src="../assets/js/bootstrap-modal.js"></script>
            <script src="../assets/js/bootstrap-dropdown.js"></script>
            <script src="../assets/js/bootstrap-scrollspy.js"></script>
            <script src="../assets/js/bootstrap-tab.js"></script>
            <script src="../assets/js/bootstrap-popover.js"></script>
            <script src="../assets/js/bootstrap-button.js"></script>
            <script src="../assets/js/bootstrap-collapse.js"></script>
            <script src="../assets/js/bootstrap-carousel.js"></script>
            <script src="../assets/js/bootstrap-typeahead.js"></script>
        -->
        <?php
        Yii::app()->clientScript->registerScript('search', "
            $('.redactor').redactor();
            $('.span3 form').live('change', function(){
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
                            <li class="<?php echo $this->id == 'default' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Главная</a>
                            </li>
                            <li class="<?php echo $this->id == 'user' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/user'); ?>">Пользователи</a>
                            </li>
                            <li class="<?php echo $this->id == 'act' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/act'); ?>">Акции</a>
                            </li>
                            <li class="<?php echo $this->id == 'theme' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/theme'); ?>">Темы</a>
                            </li>
                            <li class="<?php echo $this->id == 'sale' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/sale'); ?>">Распродажи</a>
                            </li>
                            <li class="<?php echo $this->id == 'option' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/option'); ?>">Опции</a></li>
                            <li class="<?php echo $this->id == 'optionValue' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/optionValue'); ?>">Ред. опций</a>
                            </li>
                            <li class="<?php echo $this->id == 'mailing' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/mailing'); ?>">Рассылки</a>
                            </li>
                            <li class="<?php echo $this->id == 'page' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/page'); ?>">Страницы</a>
                            </li>
                            <li class="<?php echo $this->id == 'town' ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createUrl('admin/town'); ?>">Города</a>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->homeUrl; ?>">Вернуться на сайт</a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
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
