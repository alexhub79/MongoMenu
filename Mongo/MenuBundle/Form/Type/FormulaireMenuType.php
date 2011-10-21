<?php
namespace Mongo\MenuBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilder;

class FormulaireMenuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('text');
		//$builder->add('menu', new MenuType());
		
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