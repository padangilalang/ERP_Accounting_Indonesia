<?php

class wsSiteController extends CController implements IWebServiceProvider
{
	public function actions()
	{
		return array(
			'user'=>array(
				'class'=>'CWebServiceAction',
				'classMap'=>array(
					'sUser',
				),
			),
		);
	}

	public function actionTest()
	{
		$wsdlUrl=Yii::app()->request->hostInfo.$this->createUrl('user');
		$client=new SoapClient($wsdlUrl);
		echo "<pre>";
		echo "login...\n";
		$client->login('admin','1234qwe');
		echo "fetching all contacts\n";
		echo $client->login('admin','1234qwe');
		echo "<br/>";
		print_r($client->getUsers());
		
/*		echo "\ninserting a new contact...";
		$model=new sUser;
		$model->username='Tester';
		$model->password='1234qwe';
		$model->salt='1234qwe';
		$model->default_group=1;
		$model->status_id=1;
		$client->saveUser($model);
		echo "done\n\n";
		echo "fetching all contacts\n";
		print_r($client->getUsers());
*/
		echo "</pre>";
		
	}

	/**
	 * This method is required by IWebServiceProvider.
	 * It makes sure the user is logged in before making changes to data.
	 * @param CWebService the currently requested Web service.
	 * @return boolean whether the remote method should be executed.
	 */
	public function beforeWebMethod($service)
	{
		$safeMethods=array(
			'login',
			'getUsers',
		);
		$pattern='/^('.implode('|',$safeMethods).')$/i';
		if(!Yii::app()->user->isGuest || preg_match($pattern,$service->methodName))
			return true;
		else
			throw new CException('Login required.');
	}

	/**
	 * This method is required by IWebServiceProvider.
	 * @param CWebService the currently requested Web service.
	 */
	public function afterWebMethod($service)
	{
	}

	/*** The following methods are Web service APIs ***/

	/**
	 * @param string username
	 * @param string password
	 * @return boolean whether login is valid
	 * @soap
	 */
	public function login($username,$password)
	{
		$identity=new UserIdentity($username,$password);
		if($identity->authenticate())
			Yii::app()->user->login($identity);
		return $identity->isAuthenticated;
	}

	/**
	 * Returns all User records.
	 * @return sUser[] the User records
	 * @soap
	 */
	public function getUsers()
	{
		return sUser::model()->findAll();
	}


	/**
	 * Deletes the specified user record.
	 * @param integer ID of the contact to be deleted
	 * @return integer number of records deleted
	 * @soap
	 */
	public function deleteUser($id)
	{
		return sUser::model()->deleteByPk($id);
	}	
	
	/**
	 * Updates or inserts a user.
	 * If the ID is null, an insertion will be performed;
	 * Otherwise it updates the existing one.
	 * @param sUser suser model
	 * @return boolean whether saving is successful
	 * @soap
	 */
	public function saveUser($sUser)
	{
		if($sUser->id > 0) // update
		{
			$sUser->isNewRecord=false;
			if(($oldUser=sUser::model()->findByPk($sUser->id))!==null)
			{
				$oldUser->attributes=$sUser->attributes;
				return $oldUser->save();
			}
			else
				return false;
		}
		else // insert
		{
			$sUser->isNewRecord=true;
			//$sUser->id=null;
			return $sUser->save();
		}
	}
	
}