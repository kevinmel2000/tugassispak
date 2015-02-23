<?php

class UserLevelController extends CoreController
{
    public $moduleName = 'User Level';
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserLevel('new');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserLevel']))
		{
			$model->attributes=$_POST['UserLevel'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'Level "'. $model->name .'" saved!');
				$model=new UserLevel('new');
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserLevel']))
		{
			$model->attributes=$_POST['UserLevel'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'Level "' . $model->name .'" updated!');
				$model = $this->loadModel($model->id);
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if ($model->validationBeforeDelete())
        {
            $this->loadModel($id)->delete();
            Yii::app()->user->setFlash('success', 'User level "' . $model->name . '" deleted!');
        }
        else
        {
            Yii::app()->user->setFlash('error', $model->onDeleteMessage);
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('userLevel/admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserLevel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserLevel']))
			$model->attributes=$_GET['UserLevel'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=UserLevel::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-level-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
