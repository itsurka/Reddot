<?php

class ActsController extends Controller {

    public $layout = '//layouts/column2';
    public $items;
    private $request_uri;
    private $id;

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function actions() {
        return array(
            'addToBasket' => array(
                'class' => 'application.components.shoppingCart.actions.AddToBasket'
            ),
            'deleteFromBasket' => array(
                'class' => 'application.components.shoppingCart.actions.DeleteFromBasket'
            ),
            'updateBasket' => array(
                'class' => 'application.components.shoppingCart.actions.UpdateBasket'
            ),
        );
    }

    public function actionRss() {
        Yii::import('ext.feed.*');

        $feed = new EFeed();

        $feed->title = Yii::app()->registry->getOption("rss_feed_name");
        $feed->description = Yii::app()->registry->getOption("rss_feed_desc");

        $feed->setImage(
        Yii::app()->registry->getOption('rss_feed_img_desc'), Yii::app()->createAbsoluteUrl("rss"), Yii::app()->createAbsoluteUrl(Yii::app()->registry->getOption("rss_feed_img"))
        );

        $feed->addChannelTag('language', 'ru-RU');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', Yii::app()->createAbsoluteUrl("rss"));

        $criteria = new CDbCriteria;
        $criteria->order = "date_start_act DESC";
        $criteria->limit = 10;
        $acts = Act::model()->findAll($criteria);
        foreach ($acts as $act) {
            $item = $feed->createNewItem();

            $item->title = $act->name_act;
            $item->link = Yii::app()->createAbsoluteUrl("acts/view/" . $act->id_act);
            $item->date = $act->date_start_act;
            $item->description = $act->short_text_act;
// this is just a test!!
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to access 'index' and 'view' actions.

                'actions' => array('index', 'view', 'archive', 'rss', 'bonus', 'map', 'addToBasket', 'deleteFromBasket', 'updateBasket', 'subscribeBonus', 'unSubscribeBonus', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
                'actions' => array('fav', 'unfav'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionView($actName) {
        $model = Act::model()->findByAttributes(array(
            'short_url' => CHtml::encode($actName),
        ));

        if (!$model)
            throw new CHttpException(404, 'Такой страницы не существует.');

        $childActions = Act::model()->findAllByAttributes(array('paid' => $model->id_act));

        if (count($childActions)) {
            array_unshift($childActions, $model);
        }
        else {
            $childActions = false;
        }

        $this->render('view', array(
            'model' => $model,
            'childActions' => $childActions,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $model = $this->loadModel();
        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel()->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionArchive() {
        $model = new Act('search');
        if (isset($_GET))
            $model->setAttributes($_GET);

        // and (coupon_count > coupon_purchased or coupon_count = 0)
        $dataProvider = $model->search('is_bonus = 0 AND ((date_end_act <= NOW()) OR  (coupon_count <= coupon_purchased and coupon_count > 0))  and paid = 0 and is_active IS TRUE');
        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('_listView', array('dataProvider' => $dataProvider));
        else
            $this->render('archive', array('dataProvider' => $dataProvider));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Act('search');
        if (isset($_GET))
            $model->setAttributes($_GET);

        if (!isset($_GET) || !array_key_exists('filter', $_GET)) {
            $model->setAttribute('filter', 'new');
        }

        $condition = 'is_bonus = 0 AND (date_start_act <= NOW() AND date_end_act >= NOW()) and paid = 0 and (coupon_count > coupon_purchased or coupon_count = 0) AND is_active IS TRUE';
        $dataProvider = $model->search($condition);

        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('_listView', array('dataProvider' => $dataProvider));
        else
            $this->render('index', array('dataProvider' => $dataProvider));
    }

    public function actionSearch() {
        $model = new ActSearchForm();
        $criteria = new CDbCriteria();

        if (isset($_GET['ActSearchForm'])) {
            $model->setAttributes($_GET['ActSearchForm']);
        }

        if (isset($_GET)) {
            $model->setAttributes($_GET);
        }

        if ($model->validate()) {
            $criteria->addSearchCondition('t.full_text_act', $model->query, true, 'OR');
            $criteria->addSearchCondition('t.name_act', $model->query, true, 'OR');
            $criteria->addSearchCondition('t.id_themes_act', $model->id_themes_act, 'AND');
        }

        $dataProvider = new CActiveDataProvider('Act', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        //'sort' => array('defaultOrder' => 't.id DESC'),
        ));

        $this->render('search', array('dataProvider' => $dataProvider, 'model' => $model,));
    }

    public function actionBonus() {
        $model = new Act('search');
        if (isset($_GET))
            $model->setAttributes($_GET);

        $dataProvider = $model->search('is_bonus = 1 AND (date_start_act <= NOW() AND date_end_act >= NOW()) and paid = 0');
        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('_listView', array('dataProvider' => $dataProvider));
        else
            $this->render('bonus', array('dataProvider' => $dataProvider));
    }

    public function actionMap() {
        $model = new Act('search');
        if (isset($_GET))
            $model->setAttributes($_GET);

        $condition = 'is_bonus = 0 AND (date_start_act <= NOW() AND date_end_act >= NOW()) and paid = 0';
        $dataProvider = $model->search($condition);

        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('_map', array(
                'dataProvider' => $dataProvider
            ));
        }
        else {
            $mapsDataProvider = $model->search($condition, 0);
            $this->render('map', array(
                'dataProvider' => $dataProvider,
                'mapsDataProvider' => $mapsDataProvider,
            ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Post('search');
        if (isset($_GET['Post']))
            $model->attributes = $_GET['Post'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Suggests tags based on the current user input.
     * This is called via AJAX when the user is entering the tags input.
     */
    public function actionSuggestTags() {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = Tag::model()->suggestTags($keyword);
            if ($tags !== array())
                echo implode("\n", $tags);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id'])) {
                if (Yii::app()->user->isGuest)
                    $condition = 'status=' . Post::STATUS_PUBLISHED . ' OR status=' . Post::STATUS_ARCHIVED;
                else
                    $condition = '';
                $this->_model = Post::model()->findByPk($_GET['id'], $condition);
            }
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Creates a new comment.
     * This method attempts to create a new comment based on the user input.
     * If the comment is successfully created, the browser will be redirected
     * to show the created comment.
     * @param Post the post that the new comment belongs to
     * @return Comment the comment instance
     */
    protected function newComment($post) {
        $comment = new Comment;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($comment);
            Yii::app()->end();
        }
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            if ($post->addComment($comment)) {
                if ($comment->status == Comment::STATUS_PENDING)
                    Yii::app()->user->setFlash('commentSubmitted', 'Thank you for your comment. Your comment will be posted once it is approved.');
                $this->refresh();
            }
        }
        return $comment;
    }

    public function actionFav() {
        if (Yii::app()->request->isAjaxRequest and isset($_GET['id'])) {
            $favorite = new Favorites();
            $favorite->id_user_fav = Yii::app()->user->id;
            $favorite->id_act_fav = (int) $_GET['id'];
            $favorite->save();

            Yii::app()->end();
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

    public function actionUnFav() {
        if (Yii::app()->request->isAjaxRequest and isset($_GET['id'])) {
            Favorites::model()->deleteAll(array(
                'condition' => 'id_user_fav = :id_user_fav AND id_act_fav = :id_act_fav',
                'params' => array(
                    ':id_user_fav' => Yii::app()->user->id,
                    ':id_act_fav' => (int) $_GET['id'],
                ),
            ));

            Yii::app()->end();
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

    public function actionSubscribeBonus() {
        if (Yii::app()->request->isAjaxRequest) {
            $lastSale = Sale::model()->getLastSale();
            if ($_POST['SaleSubscribe'] && $lastSale) {
                $model = new SaleSubscribe();
                $model->setAttributes($_POST['SaleSubscribe']);
                $model->user_id = Yii::app()->user->id;
                $model->sale_id = $lastSale->id;
                if ($model->save()) {
                    Yii::app()->user->setState('isSubscribed_' . $lastSale->id, $model->id);
                    Yii::app()->end();
                }
            }
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

    public function actionUnSubscribeBonus() {
        if (Yii::app()->request->isAjaxRequest) {
            $lastSale = Sale::model()->getLastSale();
            if ($lastSale) {
                $stateSaleSubscribeId = Yii::app()->user->hasState('isSubscribed_' . $lastSale->id);
                if ($stateSaleSubscribeId) {
                    SaleSubscribe::model()->deleteByPk((int) $stateSaleSubscribeId);
                    Yii::app()->user->setState('isSubscribed_' . $lastSale->id, null);
                }

                if (!Yii::app()->user->isGuest) {
                    $criteria = new CDbCriteria();
                    $criteria->condition = 'sale_id = :sale_id AND user_id = :user_id';
                    $criteria->params = array(
                        ':sale_id' => $lastSale->id,
                        ':user_id' => Yii::app()->user->id,
                    );

                    $model = SaleSubscribe::model()->find($criteria);
                    $model->delete();

                    Yii::app()->end();
                }
            }
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

}