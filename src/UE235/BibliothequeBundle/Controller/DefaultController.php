<?php

namespace UE235\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UE235\BibliothequeBundle\Entity\Auteur;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->container->get('doctrine')->getManager();
		$categories = $em->getRepository('UE235BibliothequeBundle:Categorie')->findAll();
    $livres = $em->getRepository('UE235BibliothequeBundle:Livre')->findAll();

        return $this->render('UE235BibliothequeBundle:Default:index.html.twig', array(
        	'categories' => $categories,
          'livre' => $livres
        ));
    }
}
