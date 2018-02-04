<?php
	
namespace UE235\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UE235\BibliothequeBundle\Entity\Auteur;
use UE235\BibliothequeBundle\Form\AuteurType;

class AuteurController extends Controller
{
    public function listerAction()
    {
    	$em = $this->container->get('doctrine')->getManager();
		$auteurs = $em->getRepository('UE235BibliothequeBundle:Auteur')->findAll();

		return $this->render('UE235BibliothequeBundle:Auteur:lister.html.twig', array(
			'auteurs'	=> 	$auteurs
		));
    }
    
    public function ajouterAction()
    {	
    	$auteur = new Auteur();
		$form = $this->createForm(new AuteurType, $auteur);

		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);

			if($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($auteur);
				$em->flush();
				return $this->redirect($this->generateUrl('ue235_auteur_lister'));
			}
		}

		return $this->render('UE235BibliothequeBundle:Auteur:ajouter.html.twig', array(
			'form' => $form->createView()
		));
    }

    public function modifierAction($id)
    {	
    	$em = $this->getDoctrine()->getManager();
		if (isset($id)){
			$auteur = $em->find('UE235BibliothequeBundle:Auteur', $id);

			if($auteur){
				$form = $this->createForm(new AuteurType, $auteur);

				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
					$form->bind($request);

					if($form->isValid()) {
						$em = $this->getDoctrine()->getManager();
						$em->persist($auteur);
						$em->flush();
						return $this->redirect($this->generateUrl('ue235_auteur_lister'));
					}
				}
			}
		}
		
		return $this->render('UE235BibliothequeBundle:Auteur:modifier.html.twig', array(
			'form' => $form->createView()
		));
    }

    public function supprimerAction($id)
    {	
    	$em = $this->getDoctrine()->getManager();

		if (isset($id)){
			$auteur = $em->find('UE235BibliothequeBundle:Auteur', $id);

			if($auteur){
				$em->remove($auteur);
	    		$em->flush();  
			}
		}

		return $this->redirect($this->generateUrl('ue235_auteur_lister'));
	}
}