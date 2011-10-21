<?php
namespace Mongo\MenuBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilder;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('id','hidden',array('required'=>false));
		
		
		$builder->add('name');
		$builder->add('title');
		
		
 		$builder->add('contenu', 'collection',array(
         'type' => new ContenuType(),
         'allow_add' => true,
         'allow_delete' => true,
         'error_bubbling' => false,
		 'prototype' => true,
		 'by_reference' => false,
        ));		

	
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Mongo\MenuBundle\Document\Menu');
    }
	
 	public function getName()
    {
        return 'menu';
    }
}