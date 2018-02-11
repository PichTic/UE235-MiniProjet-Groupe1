<?php

namespace UE235\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Livre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="UE235\BibliothequeBundle\Entity\Categorie", inversedBy="livres")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="UE235\BibliothequeBundle\Entity\Auteur", cascade={"persist"})
     */
    private $auteurs;

    /**
     * @ORM\Column(name="couverture_url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(name="couverture_alt", type="string", length=255)
     */
    private $alt;

    public function __construct()
    {
        $this->auteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre.
     *
     * @param string $titre
     *
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Livre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set categorie.
     *
     * @param UE235\BibliothequeBundle\Entity\Categorie $categorie
     */
    public function setCategorie(\UE235\BibliothequeBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * Get categorie.
     *
     * @return UE235\BibliothequeBundle\Entity\Categorie $categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add auteurs.
     *
     * @param UE235\BibliothequeBundle\Entity\Auteur $auteurs
     */
    public function addAuteurs(\UE235\BibliothequeBundle\Entity\Auteur $auteurs)
    {
        $this->auteurs[] = $auteurs;
    }

    /**
     * Get auteurs.
     *
     * @return Doctrine\Common\Collections\Collection $auteurs
     */
    public function getAuteurs()
    {
        return $this->auteurs;
    }

    /**
     * Add auteurs.
     *
     * @param \UE235\BibliothequeBundle\Entity\Auteur $auteurs
     *
     * @return Livre
     */
    public function addAuteur(\UE235\BibliothequeBundle\Entity\Auteur $auteurs)
    {
        $this->auteurs[] = $auteurs;

        return $this;
    }

    /**
     * Remove auteurs.
     *
     * @param \UE235\BibliothequeBundle\Entity\Auteur $auteurs
     */
    public function removeAuteur(\UE235\BibliothequeBundle\Entity\Auteur $auteurs)
    {
        $this->auteurs->removeElement($auteurs);
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Couverture
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Couverture
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
}
