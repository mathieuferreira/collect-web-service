<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Document\User;

class DefaultControllerTest extends WebTestCase
{
    public function testCollect()
    {

        $client = static::createClient();

        $user = $client->getContainer()->get('doctrine_mongodb')->getManager()->getRepository(User::class)->findOneBy(['userId' => 'test-wizbii']);

        if($user === NULL){
            $user = new User();
            $user->setUserId('test-wizbii');
            $user->setFirstName('Test');
            $user->setLastName('Wizbii');
            $user->setEmail('test@wizbii.fr');

            $client->getContainer()->get('doctrine_mongodb')->getManager()->persist($user);
            $client->getContainer()->get('doctrine_mongodb')->getManager()->flush();
        }

        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isNotFound());
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        $this->assertContains('"s":false', $client->getResponse()->getContent());

        // Missing datas
        $this->executeTestForData($client, ['v'=>1], false);

        // unknown userId
        $this->executeTestForData($client, ['v'=>1,'t'=>'pageview', 'wct'=>'visitor', 'wui'=>'1234', 'wuui'=>3, 'tid'=>'UA-1234-Y', 'ds'=>'web'], false);

        // Bad format tid
        $this->executeTestForData($client, ['v'=>1,'t'=>'pageview', 'wct'=>'visitor', 'wui'=>$user->getUserId(), 'wuui'=>3, 'tid'=>'UA-1234', 'ds'=>'web'], false);

        // Bad version
        $this->executeTestForData($client, ['v'=>2,'t'=>'pageview', 'wct'=>'visitor', 'wui'=>$user->getUserId(), 'wuui'=>3, 'tid'=>'UA-1234-Y', 'ds'=>'web'], false);

        // Missing data for ds-apps
        $this->executeTestForData($client, ['v'=>1,'t'=>'pageview', 'wct'=>'visitor', 'wui'=>$user->getUserId(), 'wuui'=>3, 'tid'=>'UA-1234-Y', 'ds'=>'apps'], false);

        // Missing data for t-event
        $this->executeTestForData($client, ['v'=>1,'t'=>'event', 'wct'=>'visitor', 'wui'=>$user->getUserId(), 'wuui'=>3, 'tid'=>'UA-1234-Y', 'ds'=>'web'], false);

        // Success
        $this->executeTestForData($client, ['v'=>1,'t'=>'pageview', 'wct'=>'visitor', 'wui'=>$user->getUserId(), 'wuui'=>3, 'tid'=>'UA-1234-Y', 'ds'=>'web'], true);
    }

    private function executeTestForData($client, $data, $success){
        $client->request('GET', '/collect', $data);

        $this->checkSuccess($client, $success);

        if($success)
            sleep(1);

        $client->request('POST', '/collect', [], [], [], json_encode([$data]));

        $this->checkSuccess($client, $success);

        if($success)
            sleep(1);
    }

    private function checkSuccess($client, $success){
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        $this->assertContains('"s"', $client->getResponse()->getContent());
        $json = json_decode($client->getResponse()->getContent(), true);

        if($success){
            $this->assertTrue($json['s'], "Success return true");
        }else{
            $this->assertFalse($json['s'], "Success return false");
            $this->assertGreaterThan(
                0,
                count($json['e']),
                "There are errors in json"
            );
        }
    }
}
