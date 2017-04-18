<?php
/**
 * Created by PhpStorm.
 * User: mathieuferreira
 * Date: 16/04/17
 * Time: 21:15
 */

namespace AppBundle\Extensions\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionEventSubscriber implements EventSubscriberInterface{

    #region Const
    #endregion
    
    #region Public Properties
    #endregion
    
    #region Protected Properties
    #endregion
    
    #region Private Properties
    #endregion
    
    #region Magic methods
    #endregion
    
    #region Getters/Setters

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => array(
                array('renderException', -10),
            )
        ];
    }

    #endregion
    
    #region Public methods

    public function renderException(GetResponseForExceptionEvent $event){
        $exception = $event->getException();

        $event->setResponse(new JsonResponse(
            [
                'success' => false,
                'message' => $exception->getMessage()
            ]
        ));
    }

    #endregion
    
    #region Protected methods
    #endregion
    
    #region Private methods
    #endregion
}