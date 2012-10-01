<div id="login">
    <div id="login_tab">
        <table class="fullWidth fullHeight">
            <tr>
                <td width="26" class="ram_tp_lf"></td>
                <td class="ram_tp" valign="bottom">
                    <div class="lg_menu_cont">
                        <a class="lg_menu_lnk active" onclick="login_set_menu(1);return false;" href="#">
                            <div class="lg_menu_lnk1">
                                <div class="lg_menu_lnk2">
                                    Вход
                                </div>
                            </div>
                        </a>
                        <a class="lg_menu_lnk" onclick="login_set_menu(2);return false;" href="#">
                            <div class="lg_menu_lnk1">
                                <div class="lg_menu_lnk2">
                                    Регистрация
                                </div>
                            </div>
                        </a>
                    </div>
                </td>
                <td class="ram_tp_rg bg_png"></td>
            </tr>
            <tr>
                <td class="ram_lf"></td>
                <td height="308">
                    <table class="fullWidth fullHeight">
                        <tr>
                            <td class="log_cn" valign="top">
                                <div class="lg_cont_div">
                                    <div class="lg_cont_tab" style="display: none;">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'login-form',
                                            'enableAjaxValidation' => true,
                                            'enableClientValidation' => true,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => true,
                                                'validateOnType' => false,
                                            ),
                                            'action' => Yii::app()->createUrl('/user/login'),
                                            'htmlOptions' => array(
                                                'class' => '',
                                        )));
                                        ?>
                                        <table class="fullWidth">
                                            <tr>
                                                <td width="300" valign="top">
                                                    <div class="lg_inpit_dv off">
                                                        <div class="lg_inpit_bg_cn">
                                                            <div class="lg_inpit_bg_lf"></div>
                                                            <?php
                                                            echo $form->textField(
                                                            $this->loginForm, 'email', array(
                                                                'class' => '',
                                                                'placeholder' => 'Введите email'
                                                            )
                                                            );
                                                            ?>
                                                            <div class="lg_inpit_bg_rg"></div>
                                                        </div>
                                                    </div>
                                                    <?php echo $form->error($this->loginForm, 'email'); ?>
                                                </td>
                                                <td>
                                                    <span id="auth_login_err" class="lg_auth_err">— введите правильно</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="300" valign="top">
                                                    <div class="lg_inpit_dv off">
                                                        <div class="lg_inpit_bg_cn">
                                                            <div class="lg_inpit_bg_lf"></div>
                                                            <?php
                                                            echo $form->passwordField(
                                                            $this->loginForm, 'password', array(
                                                                'class' => '',
                                                                'placeholder' => 'Введите пароль'
                                                            )
                                                            );
                                                            ?>
                                                            <div class="lg_inpit_bg_rg"></div>
                                                        </div>
                                                    </div>
                                                    <?php echo $form->error($this->loginForm, 'password'); ?>
                                                </td>
                                                <td>
                                                    <span id="auth_pass_err" class="lg_auth_err">— не верный пароль</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="20"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="fullWidth">
                                                        <tr>
                                                            <td width="160" align="center" valign="middle">
                                                                <a href="<?php echo Yii::app()->urlManager->createUrl('/site/recovery'); ?>">
                                                                    Восстановить доступ
                                                                </a>
                                                            </td>
                                                            <td align="right">
                                                                <?php echo CHtml::submitButton('', array('class' => 'lg_enter_butt')) ?>
                                                            </td>
                                                            <td width="8"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <?php $this->endWidget(); ?>
                                    </div>
                                    <div class="lg_cont_tab" style="display: none;">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'register-form',
                                            'enableAjaxValidation' => true,
                                            'enableClientValidation' => true,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => true,
                                                'validateOnType' => false,
                                            ),
                                            'action' => Yii::app()->createUrl('/user/register'),
                                            'htmlOptions' => array(
                                                'class' => '',
                                            ),
                                        ))
                                        ?>
                                        <table class="fullWidth">
                                            <tr>
                                                <td width="300" valign="top">
                                                    <div class="lg_inpit_dv off">
                                                        <div class="lg_inpit_bg_lf"></div>
                                                        <div class="lg_inpit_bg_cn">
                                                            <?php
                                                            echo $form->textField(
                                                            $this->registerForm, 'email', array(
                                                                'class' => '',
                                                                'placeholder' => 'Введите email'
                                                            )
                                                            );
                                                            ?>
                                                        </div>
                                                        <div class="lg_inpit_bg_rg"></div>
                                                    </div>
                                                    <?php echo $form->error($this->registerForm, 'email'); ?>
                                                </td>
                                                <td>
                                                    <span id="reg_login_comment" class="reg_input_comment">— будет логином</span>
                                                    <span id="reg_login_err" class="lg_auth_err">— введите правильно</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td width="300" valign="top">
                                                    <div class="lg_inpit_dv off">
                                                        <div class="lg_inpit_bg_cn">
                                                            <div class="lg_inpit_bg_lf"></div>
                                                            <?php
                                                            echo $form->passwordField(
                                                            $this->registerForm, 'password', array(
                                                                'class' => '',
                                                                'placeholder' => 'Введите пароль'
                                                            )
                                                            )
                                                            ?>
                                                            <div class="lg_inpit_bg_rg"></div>
                                                        </div>
                                                    </div>
                                                    <?php echo $form->error($this->registerForm, 'password'); ?>
                                                </td>
                                                <td class="lg_input_comment">
                                                    <span id="reg_pass_comment" class="reg_input_comment">— мин. 8 символов</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td height="25" class="lg_tx_norm" valign="top">
                                                    &nbsp;Ваш город:
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $form->dropDownList($this->registerForm, 'id_towns_user', Town::model()->townsListData, array('class' => '')) ?>
                                                    <?php echo $form->error($this->registerForm, 'id_towns_user'); ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="10"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="checkbox">
                                                        <?php $form->checkBox($this->registerForm, 'confirm'); ?>
                                                        <span class="check"></span>
                                                    </span>
                                                    <div class="lg_check_label">С условиями <a href="#">оферты</a> согласен</div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td height="60" colspan="2" align="center" valign="bottom">
                                                    <?php echo CHtml::submitButton('', array('class' => 'lg_register_butt')) ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php $this->endWidget(); ?>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="ram_rg"></td>
            </tr>
            <tr>
                <td class="ram_bt_lf"></td>
                <td class="ram_bt" valign="top">
                    <table style="margin-top: 17px;">
                        <tr>
                            <td width="14"></td>
                            <td class="lg_tx_norm" width="170" align="left" valign="middle">
                                Войти через соц. сеть
                            </td>
                            <td>
                                <?php
                                $this->widget('application.components.UloginWidget', array(
                                    'params' => array(
                                        'fields' => 'first_name,last_name,email,city',
                                        'providers' => 'vkontakte,facebook,twitter,mailru',
                                        'hidden' => '',
                                        'redirect' => CHtml::normalizeUrl(Yii::app()->createAbsoluteUrl('/user/ulogin')),
                                    )
                                ))
                                ?>
                                <?php /* <a class="lg_ent_soc_set" href="#"></a> */ ?>
                            </td>
                        </tr>
                    </table>

                </td>
                <td class="ram_bt_rg"></td>
            </tr>
        </table>
    </div>
</div>
<div id="city_dv">
    <table class="city_tab" align="center">
        <tr>
            <td width="10"></td>
            <td>
                <table class="fullWidth">
                    <tr>
                        <td height="25"></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <?php foreach ($this->towns as $town): ?>
                                <div class="city_link_col">
                                    <div class="city_link_dv">
                                        <div class="city_link_1">></div>
                                        <a class="city_link_2" href="<?php echo Yii::app()->createUrl('user/town/id/' . $town->id_towns); ?>">
                                            <?php echo $town->name_towns; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="62" valign="top" align="right">
                <a class="butt_city_up" href="javascript:hide_city_block();">
                    <div>Свернуть</div></a>
            </td>
        </tr>
        <tr>
            <td></td>
            <td height="32" valign="bottom">
                <div class="ico_city_strel_up"></div>
            </td>
            <td></td>
        </tr>
    </table>
</div>
