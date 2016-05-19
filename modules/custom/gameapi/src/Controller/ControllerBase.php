<?php

namespace Drupal\gameapi\Controller;

use Drupal\Core\Controller\ControllerBase as BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 *	Abstract Class for our REST API
 *	@author Fajar Khairil
 */

abstract class ControllerBase extends BaseController
{
	protected function serialize($message,$format)
	{
		// is this correct format ?
		if(! in_array($format, ['json','xml'])){
			throw new \RuntimeException('invalid format supplied '.$format);
		}

		$serializer = \Drupal::service('serializer');
		$content = $serializer->serialize(['Result' => "OK",'Message' => $message],$format);
		
		return new Response( $content );
	}

	/**
	 *
	 *	show proper error message to API consumer
	 *
	 */
	protected function renderError($message,$format)
	{
		// is this correct format ?
		if(! in_array($format, ['json','xml'])){
			throw new \RuntimeException('invalid format supplied '.$format);
		}

		$serializer = \Drupal::service('serializer');
		$content = $serializer->serialize( ['Result' => "ERROR",'Message' => $message],$format);

		return new Response( $content,500 );		
	}
}