<?php

namespace Drupal\gameapi\Controller;

use Drupal\Core\Controller\ControllerBase;

class UserController extends ControllerBase
{
	public function content() 
	{
		return array(
		    '#type' => 'markup',
		    '#markup' => $this->t('Hello, World!'),
		);
	}
}