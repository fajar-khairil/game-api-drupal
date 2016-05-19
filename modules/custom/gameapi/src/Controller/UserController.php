<?php

namespace Drupal\gameapi\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ControllerBase
{
	public function postRegister()
	{
		$request = \Drupal::request();

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
			_user_mail_notify('status_activated',$user);

			return $this->serialize(
				['Result' => "OK",'Message' => 'User Berhasil registrasi'],
				$request->get('_format','json')
			);
		}
		catch(\Exception $e)
		{
			// send 500 status code
			return new Response($e->getMessage(),500);	
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

	protected function serialize($data,$format)
	{
		$serializer = \Drupal::service('serializer');
		return new Response($serializer->serialize($data,$format));
	}
}