<?php

class SiteController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(array('userAuth/login'));
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}