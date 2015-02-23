<?php

class CoreController extends Controller
{
	public $layout = '//layouts/main';
	public $moduleName = '';
	public $modules = array();
    public $breadcrumbs = array();
    public $menu = array();
	
	function init()
	{
		// check privilage on every requet
		// inherited to all child CoreController
		$this->checkPrivilage();
        
        // fetch accessible modules
		$this->modules = $this->fetchModules();
	}
	
	function checkPrivilage()
	{
		// throw to login if guest
		if(Yii::app()->user->isGuest)
		{
			$this->redirect(array('userAuth/login'));
		}
		else
		{
            // if using module
			$controllerName = $this->id;
			$userLevelId = Yii::app()->user->userLevelId;
			
            // bypass login user if accessing appUser
            if($controllerName == 'appUser')
			{
				return;
			}
			
			// fetch user privilages 
			$criteria = new CDbCriteria();
			$criteria->select = 't.*';
			$criteria->join = 'LEFT JOIN module_privilage as mp ON t.id = mp.module_id';
			$criteria->condition = 'mp.user_level_id = :userLevelId AND t.url = :url';
			$criteria->params = array(":userLevelId" => $userLevelId, 
                                    "url" => $controllerName
								);
			
			$modules = Module::model()->findAll($criteria);
            
			if(!isset($modules) || count($modules) == 0)
			{
				$this->redirect(array('appUser/noAccess'));
			}
		}
	}
	
	function fetchModules()
	{
		$userLevelId = Yii::app()->user->userLevelId;
		$arrIdParentModule = array();
		
		// fetch parent id join with privilages
		$criteria = new CDbCriteria();
		$criteria->distinct = true;
		$criteria->select = 't.p_id';
		$criteria->join = 'LEFT JOIN module_privilage as mp ON t.id = mp.module_id';
		$criteria->condition = 'mp.user_level_id = :userLevelId';
		$criteria->params = array(":userLevelId" => $userLevelId);
		
		$modules = Module::model()->findAll($criteria);

		for($x=0;$x<count($modules);$x++)
		{
			$arrIdParentModule[] = $modules[$x]->p_id;
		}
	
		// fetch parent
		$criteria = new CDbCriteria();
		$criteria->addInCondition('id', $arrIdParentModule, 'OR');
		$modules = Module::model()->findAll($criteria);
		
		return $modules;
	}
}