<?php

class UserAuthController extends Controller
{	
	public $layout = '//layouts/login';
	
	public function actionIndex()
	{
		$this->redirect(array('userAuth/login'));
	}
	
	public function actionLogin()
    {
		if(!Yii::app()->user->isGuest)
		{
			$this->redirect(array('fisProject/index'));
		}
		
        $model = new FormLogin();

        if (isset($_POST['FormLogin']))
        {
            $model->attributes = $_POST['FormLogin'];
			$model->username = $_POST['FormLogin']['username'];
			
            if ($model->validate() && $model->login())
            {
                $this->redirect(array('fisProject/index'));
            }
        }
	
		$model->password = '';
		
        $this->render('login', array(
            'model' => $model,
        ));
    }

    public function actionLogout()
    {
		if(Yii::app()->user->isGuest)
		{
			$this->redirect(array('userAuth/login'));
		}
		
        Yii::app()->user->logout();
        $this->redirect(array('userAuth/login'));
    }
}