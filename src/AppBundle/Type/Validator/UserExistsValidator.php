<?php
/**
 * Created by PhpStorm.
 * User: mathieuferreira
 * Date: 16/04/17
 * Time: 20:37
 */

namespace AppBundle\Type\Validator;


use AppBundle\Document\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\VarDumper\VarDumper;

class UserExistsValidator extends ConstraintValidator{

    #region Const
    #endregion
    
    #region Public Properties
    #endregion
    
    #region Protected Properties
    #endregion
    
    #region Private Properties

    /** @var AbstractmanagerRegistry */
    private $mongoDoctrine;

    #endregion
    
    #region Magic methods

    public function __construct(AbstractmanagerRegistry $mongoDoctrine){
        $this->mongoDoctrine = $mongoDoctrine;
    }

    #endregion
    
    #region Getters/Setters
    #endregion
    
    #region Public methods

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UserExists) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\UserExists');
        }

        $user = $this->mongoDoctrine->getManager()->getRepository(User::class)->findOneBy(['userId' => $value]);

        if ($user === NULL){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation();
        }
    }

    #endregion
    
    #region Protected methods
    #endregion
    
    #region Private methods
    #endregion
}