<?php
// src/Acme/AccountBundle/Form/Type/RegistrationType.php
namespace Mongo\MenuBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilder;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('menu', new MenuType());
        $builder->add('idmenu', 'hidden');
    }

    public function getName()
    {
        return 'registration';
    }
}