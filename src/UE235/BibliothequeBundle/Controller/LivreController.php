<?php
	
namespace UE235\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UE235\BibliothequeBundle\Entity\Livre;
use UE235\BibliothequeBundle\Form\LivreType;

class LivreController extends Controller
{
    public function listerAction()
    {
    	$em = $this->container->get('doctrine')->getManager();
		$livres = $em->getRepository('UE235BibliothequeBundle:Livre')->findAll();

		return $this->render('UE235BibliothequeBundle:Livre:lister.html.twig', array(
			'livres'	=> 	$livres
		));
    }
    
    public function voirAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	if(isset($id)){
            $livre = $em->find('UE235BibliothequeBundle:Livre', $id);
			return $this->render('UE235BibliothequeBundle:Livre:voir.html.twig', array(
				'livre' => $livre
			));
        }   
        return $this->redirect($this->generateUrl('ue235_livre_lister'));
    }

    public function ajouterAction()
    {	
    	$livre = new Livre();
		$form = $this->createForm(new LivreType, $livre);

		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);

			if($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($livre);
				$em->flush();
				return $this->redirect($this->generateUrl('ue235_livre_lister'));
			}
		}
		return $this->render('UE235BibliothequeBundle:Livre:ajouter.html.twig', array(
			'form' => $form->createView()
		));
    }

    public function modifierAction($id)
    {	
    	$em = $this->getDoctrine()->getManager();
		if (isset($id)){
			$livre = $em->find('UE235BibliothequeBundle:Livre', $id);

			if($livre){
				$form = $this->createForm(new LivreType, $livre);

				$request = $this->get('request');
				if ($request->getMethod() == 'POST') {
					$form->bind($request);

					if($form->isValid()) {
						$em = $this->getDoctrine()->getManager();
						$em->persist($livre);
						$em->flush();
						return $this->redirect($this->generateUrl('ue235_livre_lister'));
					}
				}
			}
		}
		return $this->render('UE235BibliothequeBundle:Livre:modifier.html.twig', array(
			'form' => $form->createView()
		));
    }

    public function supprimerAction($id)
    {	
    	$em = $this->getDoctrine()->getManager();

		if (isset($id)){
			$livre = $em->find('UE235BibliothequeBundle:Livre', $id);

			if($livre){
				$em->remove($livre);
	    		$em->flush();  
			}
		}

		return $this->redirect($this->generateUrl('ue235_livre_lister'));
	}
}