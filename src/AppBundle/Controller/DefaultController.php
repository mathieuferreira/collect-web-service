<?php

namespace AppBundle\Controller;

use AppBundle\Document\Data;
use AppBundle\Type\CollectType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\FormError;
use AppBundle\Extensions\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller
{
    /**
     * @Route("/collect", name="collect")
     * @Method({"GET", "POST"})
     */
    public function collectAction(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', CollectionType::class, null, [
            'method' => $request->getMethod(),
            'entry_type'=> CollectType::class,
            'allow_add' => true,
            'constraints' => [
                new Count(['min' => 1])
            ],
            'csrf_protection' => false
        ]);

        $form->submit($request->getMethod() === 'GET' ? [$request->query->all()] : json_decode($request->getContent(), true), true);

        if($form->isValid()){
            $mongoManager = $this->getMongoManager();
            foreach($form as $child){
                $mongoManager->persist($child->getData());
            }

            $mongoManager->flush();

            return $this->json(['s' => true]);
        }

        $json = [
            's' => false,
            'e' => []
        ];

        /** @var FormError $error */
        foreach($form->getErrors(true) as $error){
            $json['e'][] = $error->getMessage();
        }

        return $this->json($json);
    }
}
