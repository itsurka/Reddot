<?php

class SearchController extends Controller
{
	public $layout='column2';
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
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view','archive'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$request_uri = Yii::app()->components['request']->pathInfo;
		$this->request_uri = explode('/', $request_uri);
		
		if(sizeof($this->request_uri)==3){
			$this->id = $this->request_uri[2];

            $this->items = Yii::app()->db->createCommand()
             ->select('*')
             ->from( 'act' )
             ->where('(name_act LIKE :id OR short_text_act LIKE :id OR full_text_act LIKE :id) AND date_start_act<=NOW() AND date_end_act>=NOW()',array(':id'=>'%'.$this->id.'%'))
             ->query()
             ->readAll();

            $i=0;
		   	foreach ($this->items as $key => $value) {
	       		$this->items[$i]['date_to_end'] = real_date_diff($this->items[$i]['date_end_act']);
	       		$i++;
		    }
		}else{
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$this->render('view');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionArchive()
	{
		$this->items = Yii::app()->db->createCommand()
             ->select('*')
             ->from( 'act' )
             ->where('date_end_act<=NOW()',array(':id'=>'NOW()'))
             ->query()
             ->readAll();
        $i=0;
       	foreach ($this->items as $key => $value) {
       		$this->items[$i]['date_to_end'] = real_date_diff($this->items[$i]['date_end_act']);
       		$i++;
       	}

		$this->render('archive');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->items = Yii::app()->db->createCommand()
             ->select('*')
             ->from( 'act' )
             ->where('date_start_act<=NOW() AND date_end_act>=NOW()',array(':id'=>'NOW()',))
             ->query()
             ->readAll();

        $i=0;
       	foreach ($this->items as $key => $value) {
       		$this->items[$i]['date_to_end'] = real_date_diff($this->items[$i]['date_end_act']);
       		$i++;
       	}
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
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
	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}
}
