<?php
/**
 * uLogin error
 * @author Nikolay Ermin <nikolay@ermin.ru>
 * @link   http://siteforever.ru
 */

/** @var $model User */
echo '<div class="error">' . $model->getError('password') . '</div>';
