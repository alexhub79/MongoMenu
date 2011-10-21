<?php
// src/Acme/AccountBundle/Form/Model/Registration.php
namespace Mongo\MenuBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Mongo\MenuBundle\Document\Menu;

class Registration
{
    /**
     * @Assert\Type(type="Mongo\MenuBundle\Document\Menu")
     */
    protected $menu;

    /**
	 *
     */
    protected $idmenu;
	
	public function setMenu(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function getMenu()
    {
        return $this->menu;
    }

	public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;
    }

    public function getIdmenu()
    {
        return $this->idmenu;
    }

}