<?php

class AppUserController extends CoreController
{
    public $moduleName = 'App User';
    
    public function actionIndex()
    {
        $this->moduleName = 'Home';
        
        $this->render('index', array(
            
        ));
    }
    
    public function actionProfile()
    {
        $this->moduleName = 'Profile';
        $userId = Yii::app()->user->userId;
        
        $this->render('profile', array(
            'model'=>$this->loadModel($userId),
        ));
    }
    
    public function actionEditProfile()
	{
        $userId = Yii::app()->user->userId;
		$model=$this->loadModel($userId);
        $model->scenario = 'update';
         
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            
            // ambil id level dari database, replace levelid request
            $existedModel = $this->loadModel($userId);
            $model->userLevel->id = $existedModel->userLevel->id;
            
			if($model->save())
			{
				Yii::app()->user->setFlash('success', 'User "' . $model->name .'" updated!');
				$model=$this->loadModel($model->id);
			}
		}

		$this->render('editProfile',array(
			'model'=>$model,
		));
	}
    
    public function actionChangePasswd()
    {
        $this->moduleName = 'Change Password';
        
        $model = new FormChangePasswd();
        
        if(isset($_POST['FormChangePasswd']))
        {
            $model->attributes = $_POST['FormChangePasswd'];
            if($model->validate())
            {
                 $user = User::model()->findByPk(Yii::app()->user->userId);
                 $user->user_passwd = md5($model->newPasswd);
                 
                 if($user->save())
                 {
                    Yii::app()->user->setFlash('success', 'Password successfully changed!');
                    $model = new FormChangePasswd();
                 }
                 else
                 {
                    Yii::app()->user->setFlash('error', 'Error saving new password!'); 
                 }
            }
        }
        
        
        $this->render('changePasswd', 
                array(
                    'model' => $model
               )
        );
    }
    
    public function actionNoAccess()
    {
        $this->render('noAccess', array());
    }
    
    public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
