<?php
namespace AppBundle\Type;
use AppBundle\Document\Data;
use AppBundle\Type\Validator\UserExists;
use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\VarDumper\VarDumper;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\MongoDB\Query\Builder;

/**
 * Created by PhpStorm.
 * User: mathieuferreira
 * Date: 16/04/17
 * Time: 14:14
 */

class CollectType extends AbstractType {

    #region Const
    #endregion
    
    #region Public Properties
    #endregion
    
    #region Protected Properties
    #endregion
    
    #region Private Properties

    /** @var int */
    private $timeout;

    /** @var AbstractManagerRegistry  */
    private $mongoDoctrine;

    #endregion
    
    #region Magic methods

    public function __construct(AbstractManagerRegistry $mongoDoctrine, $timeout){
        $this->timeout = $timeout;
        $this->mongoDoctrine = $mongoDoctrine;
    }

    #endregion
    
    #region Getters/Setters
    #endregion
    
    #region Public methods

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('v', TextType::class, [
                'property_path' => 'version',
                'constraints' => [
                    new NotBlank(['message' => 'Version (v) cannot be blank.']),
                    new Choice(['choices' => ['1'], 'message' => 'Version (v) not supported.'])
                ]
            ])
            ->add('t', TextType::class, [
                'property_path' => 'hitType',
                'constraints' => [
                    new NotBlank(['message' => 'Hit type (t) cannot be blank.']),
                    new Choice([
                        'choices' => Data::$hitTypes,
                        'message' => sprintf('Hit type (t) not supported. Supported values : %s', implode(',', Data::$hitTypes))
                    ])
                ]
            ])
            ->add('dl', TextType::class, [
                'property_path' => 'documentLocation',
                'constraints' => [
                    //new Url(['message' => 'Document location (dl) has to be a valid Url.'])
                ]
            ])
            ->add('dr', TextType::class, [
                'property_path' => 'documentReferer',
                'constraints' => [
                    //new Url(['message' => 'Document referer (dr) has to be a valid Url.'])
                ]
            ])
            ->add('wct', TextType::class, [
                'property_path' => 'creatorType',
                'constraints' => [
                    new NotBlank(['message' => 'Wizbii creator type (wct) cannot be blank.']),
                    new Choice([
                        'choices' => Data::$creatorTypes,
                        'message' => sprintf('Wizbii creator type (wct) not supported. Supported values : %s', implode(',', Data::$creatorTypes))
                    ])
                ]
            ])
            ->add('wui', TextType::class, [
                'property_path' => 'userId',
                'constraints' => [
                    new NotBlank(['message' => 'Wizbii User id (wui) cannot be blank.']),
                    new UserExists()
                ]
            ])
            ->add('wuui', TextType::class, [
                'property_path' => 'uniqUserId',
                'constraints' => [
                    new NotBlank(['message' => 'Wizbii Uniq User id (wuui) cannot be blank.'])
                ]
            ])
            ->add('ec', TextType::class, [
                'property_path' => 'eventCategory',
                'constraints' => [
                    new NotBlank(['groups' => ['t-event'], 'message' => 'Event category (ec) cannot be blank.'])
                ]
            ])
            ->add('ea', TextType::class, [
                'property_path' => 'eventAction',
                'constraints' => [
                    new NotBlank(['groups' => ['t-event'], 'message' => 'Event action (ea) cannot be blank.'])
                ]
            ])
            ->add('el', TextType::class, ['property_path' => 'eventLabel'])
            ->add('ev', IntegerType::class, [
                'property_path' => 'eventValue',
                'constraints' => [
                    new Type(['type' => 'integer', 'message' => 'Event value (ev) has to be an integer.']),
                    new GreaterThan(['value' => 0, 'message' => 'Event value (ev) has to be a positive integer.'])
                ],
                'data' => 1
            ])
            ->add('tid', TextType::class, [
                'property_path' => 'trackingId',
                'constraints' => [
                    new NotBlank(['message' => 'Tracking id (tid) cannot be blank.']),
                    new Regex(['pattern' => '/^UA\-[a-zA-Z0-9]{4}\-[a-zA-Z0-9]{1}$/', 'message' => 'Tracking id (tid) has to be formatted like UA-XXXX-Y.'])
                ]
            ])
            ->add('ds', TextType::class, [
                'property_path' => 'dataSource',
                'constraints' => [
                    new NotBlank(['message' => 'Data source (ds) cannot be blank.']),
                    new Choice([
                        'choices' => Data::$dataSources,
                        'message' => sprintf('Data source (ds) not supported. Supported values : %s', implode(',', Data::$dataSources))
                    ])
                ]
            ])
            ->add('cn', TextType::class, ['property_path' => 'campaignName'])
            ->add('cs', TextType::class, ['property_path' => 'campaignSource'])
            ->add('cm', TextType::class, ['property_path' => 'campaignMedium'])
            ->add('ck', TextType::class, ['property_path' => 'campaignKeyword'])
            ->add('cc', TextType::class, ['property_path' => 'campaignContent'])
            ->add('sn', TextType::class, [
                'property_path' => 'screenName',
                'constraints' => [
                    new NotBlank(['groups' => ['t-screenview'], 'message' => 'Screen name (sn) cannot be blank.'])
                ]
            ])
            ->add('an', TextType::class, [
                'property_path' => 'applicationName',
                'constraints' => [
                    new NotBlank(['groups' => ['ds-apps'], 'message' => 'Application name (an) cannot be blank.'])
                ]
            ])
            ->add('av', TextType::class, ['property_path' => 'applicationVersion'])
            ->add('qt', IntegerType::class, [
                'property_path' => 'queueTime',
                'constraints' => [
                    new Type(['type' => 'integer', 'message' => 'Queue time (qt) has to be an integer.']),
                    new Range([
                        'min' => 0,
                        'max' => $this->timeout,
                        'minMessage' => 'Queue time (qt) has to be greater than 0.',
                        'maxMessage' => sprintf('Queue time (qt) has to be lesser than %d.', $this->timeout)
                    ])

                ],
                'data' => 0
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('data_class', Data::class);
        $resolver->setDefault('validation_groups', function(FormInterface $form){
            return [
                'Default',
                't-' . $form->get('t')->getData(),
                'ds-' . $form->get('ds')->getData()
            ];
        });

        $resolver->setNormalizer('constraints', function(Options $options, $value){
            return array_merge(
                $value,
                [
                    new Callback(['callback' => function($value, ExecutionContextInterface $context){
                        /** @var Data $value */
                        /** @var Builder $queryBuilder */
                        $queryBuilder = $this->mongoDoctrine->getManager()->getRepository(Data::class)->createQueryBuilder('d');
                        $queryBuilder->addAnd(
                            $queryBuilder->expr()->addAnd(
                                $queryBuilder->expr()->field('userId')->equals($value->getUserId()),
                                $queryBuilder->expr()->field('hitType')->equals($value->getHitType()),
                                $queryBuilder->expr()->field('collectDate')->gte(time() - 1)
                            )
                        );
                        $data = $queryBuilder->getQuery()->getSingleResult();

                        if ($data !== NULL){
                            $context->buildViolation('An event cannot occurred more than one time a second')
                                ->addViolation();
                        }
                    }])
                ]
            );
        });
    }

    #endregion
    
    #region Protected methods
    #endregion

    #region Private methods
    #endregion
}