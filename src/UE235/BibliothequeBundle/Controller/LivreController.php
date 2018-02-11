<?php

namespace UE235\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use UE235\BibliothequeBundle\Entity\Livre;
use UE235\BibliothequeBundle\Form\LivreType;

class LivreController extends Controller
{
    /**
     * Liste les livres.
     */
    public function listerAction()
    {
        $em = $this->container->get('doctrine')->getManager();
        $livres = $em->getRepository('UE235BibliothequeBundle:Livre')->findAll();

        return $this->render('UE235BibliothequeBundle:Livre:lister.html.twig', [
            'livres'	=> $livres,
        ]);
    }

    /**
     * Consulter un livre $id.
     *
     * @param int $id
     */
    public function voirAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (isset($id)) {
            $livre = $em->find('UE235BibliothequeBundle:Livre', $id);

            return $this->render('UE235BibliothequeBundle:Livre:voir.html.twig', [
                'livre' => $livre,
            ]);
        }

        return $this->redirect($this->generateUrl('ue235_livre_lister'));
    }

    /**
     * Ajouter un livre.
     */
    public function ajouterAction()
    {
        $livre = new Livre();
        $form = $this->createForm(new LivreType(), $livre);

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                // $file stores the uploaded image file
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $livre->getCouverture();

                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                // moves the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('couvertures_dir'),
                    $fileName
                );

                // updates the 'couverture' property to store the image file name
                // instead of its contents
                $livre->setCouverture($fileName);

                $em = $this->getDoctrine()->getManager();
                $em->persist($livre);
                $em->flush();

                return $this->redirect($this->generateUrl('ue235_livre_lister'));
            }
        }

        return $this->render('UE235BibliothequeBundle:Livre:ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifier le livre $id.
     *
     * @param int $id
     */
    public function modifierAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        if (isset($id)) {
            $livre = $em->find('UE235BibliothequeBundle:Livre', $id);

            if ($livre) {
                $form = $this->createForm(new LivreType(), $livre);

                $request = $this->get('request');
                if ('POST' == $request->getMethod()) {
                    $form->bind($request);

                    if ($form->isValid()) {
                        // $file stores the uploaded image file
                        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                        $file = $livre->getCouverture();

                        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                        // moves the file to the directory where brochures are stored
                        $file->move(
                            $this->getParameter('couvertures_dir'),
                            $fileName
                        );

                        // updates the 'couverture' property to store the image file name
                        // instead of its contents
                        $livre->setCouverture($fileName);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($livre);
                        $em->flush();

                        return $this->redirect($this->generateUrl('ue235_livre_lister'));
                    }
                }
            }
        }

        return $this->render('UE235BibliothequeBundle:Livre:modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un livre.
     *
     * @param int $id
     */
    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if (isset($id)) {
            $livre = $em->find('UE235BibliothequeBundle:Livre', $id);

            if ($livre) {
                $em->remove($livre);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('ue235_livre_lister'));
    }
}
