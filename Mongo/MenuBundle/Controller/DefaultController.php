<?php

namespace Mongo\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



use Mongo\MenuBundle\Form\Type\ContenuType;
use Mongo\MenuBundle\Form\Type\MenuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  
	/**
     * @Route("/listemenu", name="listmongo")
     * @Template()
    */
	public function listemenuAction(Request $request)
	{
		$mandango = $this->container->get('mandango');
		$menuRepository = $mandango->getRepository('Model\MongoMenuBundle\Menu');
		/*	
		
		$article->setTitle("pppp ");
		$article->setName("kk11");
		$article->save();
		*/
	
		//$result  = $menuRepository->findOneById('4e95c09e7bd2bb8c17000005');
		//
		//$result2->moveUp();
		//$result->setPosition(1);
		//$result->save();
		
		
	//	$menu  = $menuRepository->findOneById('4e9837ff7bd2bba415000003');
		
		/*
		
		$menu = $mandango->create('Model\MongoMenuBundle\Menu');
		$menu->setTitle("test trad");
		$menu->setName("test trad");
		
		$menuT = $menu->translation('es');
		$menuT->setTraduc('spain title');
		
		$menuE = $menu->translation('en');
		$menuE->setTraduc('english title');
*/
		//$menuT->translation('es')->setTraduc('spain title')->save();
		//$menuT->translation('es')->setTraduc('spain2 title')->save();
		/*
		$enTranslation->setTraduc('english title');
		$enTranslation->save();
        $esTranslation = $menu->translation('es');
		$esTranslation->setTraduc('spain title');
		$esTranslation->save();
		
		$tab[] = $menuT;
		$tab[] = $menuE;
		$menu->addTranslations($tab);
		$menu->save();
		
		*/
		$menuRepository2 = $mandango->getRepository('Model\MongoMenuBundle\Menu');
		$menu = $menuRepository2->createQuery(); 
		$menu->sort(array('position'=>1));
		

		return $this->render('MongoMenuBundle:Default:liste.html.twig', array('menu'=>$menu));
	}
	
	
	/**
     * @Route("/createmenu", name="formmongocreate")
     * @Template()
    */
	public function createAction(Request $request)
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$document = new Menu();
		$form = $this->createForm(new MenuType(),$document);
		// On vérifie qu'elle est de type « POST ».
		if( $request->getMethod() == 'POST' ):
			// On fait le lien Requête <-> Formulaire.
			$form->bindRequest($request);
			if( $form->isValid() ):
				// On récupère notre objet.
				$dataform = $form->getData();
				$dm->persist($dataform);
				foreach($dataform->getContenu() as $cont):  // On persiste tous les tags de l'article.
						$dm->persist($cont);
				endforeach;
				$dm->flush();
				return $this->redirect('listemenu');
			endif;
		endif;
		$menu = $dm->getRepository('MongoMenuBundle:Menu')->findAllOrderedByName();
		return $this->render('MongoMenuBundle:Default:createform.html.twig', array('form' => $form->createView(),'menu'=>$menu));
    }
	
	/**
     * @Route("/mongoformulaire", name="formmongo")
     * @Template()
    */
	public function updateAction(Request $request)
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$idmenu = false;
		$request = $this->get('request');
		if($this->get('request')->query->get('idmenu')) $idmenu = $this->get('request')->query->get('idmenu');
		if($this->get('request')->request->get('idmenu')) $idmenu = $this->get('request')->request->get('idmenu');
		if( $idmenu!== false):
			$document = $dm->getRepository('MongoMenuBundle:Menu')->find($idmenu);
			if (!$document):
				throw $this->createNotFoundException('No Menu found for id '.$request->query->get('idmenu'));
			endif;
		else:
			$document = new Menu();
		endif;
		
		$form = $this->createForm(new MenuType(),$document);
		if( $request->getMethod() == 'POST' ):
		// On fait le lien Requête <-> Formulaire.
		$form->bindRequest($request);
		if( $form->isValid() ):
			// On récupère notre objet.
			$dataform = $form->getData();
			$document = $dm->getRepository('MongoMenuBundle:Menu')->find($dataform->getId());
			if($document):
				$dm->remove($document);
				$dm->flush();
				$dm->persist($dataform);
				foreach($dataform->getContenu() as $cont):  // On persiste tous les tags de l'article.
						$dm->persist($cont);
				endforeach;
				$dm->flush();
			endif;
		endif;
		endif;
		$menu = $dm->getRepository('MongoMenuBundle:Menu')->findAllOrderedByName();
		return $this->render('MongoMenuBundle:Default:formulaire.html.twig', array('form' => $form->createView(),'menu'=>$menu));
    }
	
	
    /**
     * @Route("/{slug}", name="routeshow")
     * @Template()
    */
	
	public function showAction()
	{
		$menu = $this->get('doctrine.odm.mongodb.document_manager')
			->getRepository('MongoMenuBundle:Menu')
			->findAllOrderedByName();
        return array('menu' => $menu);
	}
    /**
     * @Route("/mongodelete", name="routedelete")
     * @Template()
    */
	public function deleteAction(Request $request)
	{
	
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
        $menu = $dm->getRepository('MongoMenuBundle:Menu')->find($this->get('request')->query->get('id'));

        if ($menu):
			$dm->remove($menu);
			$dm->flush();
        endif;

		$menu2 = $this->get('doctrine.odm.mongodb.document_manager')
			->getRepository('MongoMenuBundle:Menu')
			->findAllOrderedByName();

        return $this->render('MongoMenuBundle:Default:liste.html.twig', array('menu'=>$menu2));		
	}
	
}
