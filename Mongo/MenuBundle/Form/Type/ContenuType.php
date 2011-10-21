<?php
namespace Mongo\MenuBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilder;

class ContenuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {  
		$builder->add('id','hidden',array('required'=>false));
		$builder->add('text', 'textarea', array('attr' => array('class' => 'ckeditor')));
		$builder->add('title');
		
		
		
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Mongo\MenuBundle\Document\Contenu');
    }
	
  	public function getName()
    {
        return 'contenu';
    }
}