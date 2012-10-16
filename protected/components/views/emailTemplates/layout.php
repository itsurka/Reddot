<?php /*header('Content-type: text/html; charset=utf-8'); */?>
<html>
    <head>

        <style type="text/css">

            .logo{
                float: left;
            }

            .websiteUrl{
                float: right;
            }

            .clear{
                clear: both;
            }

            .content p{
                padding: 0;
                margin: 21px 0;
            }

            .main{
                width: 800px;
                font-family: sans-serif;
                font-size: 0.9em;
            }

            .footer{
                color: gray;
                font-size: 0.9em;
                margin-top: 50px;
            }

            .content{
                margin-top: 26px;
            }

            .title{
                margin-bottom: 28px
            }

            .actName{
                margin-bottom: 40px;
            }

            .title2{
                font-size: 1.1em;
            }

            .coupon{
                margin-bottom: 40px;
            }

            .coupon .coupon-title{
                margin-bottom: 10px;
            }

            .coupon .coupon-title a{
                color: #006FFF;
                font-weight: bold;
            }

            .coupon .coupon-left{
                float: left;
                width: 300px;
            }

            .coupon .coupon-right{
                float: left;
                margin-left: 30px;
            }

            .coupon ul{
                margin-bottom: 10px;
                margin-top: 10px;
                padding-left: 10px;
                list-style-type: none;
            }

            .coupon .coupon-code{
                color: #FF7500;
                font-size: 2em;
                margin: 4px 0;
            }

            .coupon .left-border{
                border-left: 3px solid red;
                padding-left: 12px;
            }

            .coupon .organization-info{
                font-size: 0.9em;
            }

        </style>

    </head>
    <body>

        <div class="main" style="width: 800px; font-family: sans-serif; font-size: 0.9em; color: #000000;">
            <div class="header">
                <div class="logo" style="float: left;">
                    <a href="<?php echo $_websiteUrl_; ?>">
                        <?php echo CHtml::image($_websiteUrl_ . '/images/reddot.jpg'); ?>
                    </a>
                </div>
                <div class="websiteUrl" style="float: right;">
                    <?php echo $_websiteLink_; ?>
                </div>
            </div>

            <div class="clear" style="clear: both;"></div>

            <div class="content" style="margin-top: 26px;">
                <?php echo $_content_; ?>
            </div>

            <div class="clear" style="clear: both;"></div>

            <div class="footer" style="color: gray; font-size: 0.9em; margin-top: 50px;">
                <div style="margin: 0px 0;">***</div>
                &copy;&nbsp;<?php echo Option::getCompanyLink(); ?><br>
                <?php echo Option::getByName('company_phone') ?><br>
                <?php echo Option::getByName('company_email') ?><br>
                Skype: <?php echo Option::getByName('company_skype') ?>
                <div style="margin: 4px 0;">******************</div>
            </div>
        </div>
    </body>
</html>