<?php

namespace Drupal\gameapi\Controller;

use Drupal\user\Entity\User;

class UserController extends ControllerBase
{
	public function postRegister()
	{
		$request = \Drupal::request();
		// fetch expected format from consumer default to json if not supplied
		$format = $request->get('_format','json');

		try
		{
			//Load user with user ID 
			$user = User::create();

			//Mandatory settings
			$user->setPassword($request->get('password'));
			$user->enforceIsNew();
			$user->setEmail($request->get('email'));
			$user->setUsername($request->get('username'));
			// set other info
			$user->set('field_first_name',$request->get('firstname'));
			$user->set('field_last_name',$request->get('lastname'));
			//Optional settings
			$user->activate();
			//Save user
			$user->save();

			// function location at => /home/fajar/www/dru-game-api/core/modules/user/user.module function _user_mail_notify()
			_user_mail_notify('status_activated',$user);

			return $this->serialize(
				'Registrasi user berhasil',
				$format
			);
		}
		catch(\Exception $e)
		{
			// send 500 status code
			return $this->renderError($e->getMessage(),$format);	
		}
	}

	public function login()
	{

	}

	public function logout()
	{

	}

	public function resetPassword()
	{

	}
}