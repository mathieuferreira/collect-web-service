<?php
/**
 * Created by PhpStorm.
 * User: mathieuferreira
 * Date: 16/04/17
 * Time: 19:43
 */

namespace AppBundle\Extensions\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller{

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

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getMongoManager(){
        if (!$this->container->has('doctrine_mongodb')) {
            throw new \LogicException('The DoctrineMongoDB is not registered in your application.');
        }

        return $this->container->get('doctrine_mongodb')->getManager();
    }

    public function json($data, $status = 200, $headers = array(), $context = array()){
        if($data instanceof Form){
            $errors = $data->getErrors(true);

            $data = [
                's' => count($errors) > 0
            ];

            if(count($errors) > 0){
                /** @var FormError $error */
                foreach($errors as $error){
                    $data['e'][] = $error->getMessage();
                }
            }
        }

        return parent::json($data, $status, $headers, $context);
    }

    #endregion
    
    #region Public methods
    #endregion
    
    #region Protected methods
    #endregion
    
    #region Private methods
    #endregion
}