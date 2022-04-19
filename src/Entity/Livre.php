<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreRepository;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     */
    private $titre;

    /**
     * @ORM\Column(type="date", nullable=true)
     * Assert\Date(message="Date invalide")
     */
    private $date_de_parution;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $auteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThan(0,message="Le nombre de pages doit être supérieur à 0")
     */
    private $nb_pages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDeParution(): ?\DateTimeInterface
    {
        return $this->date_de_parution;
    }

    public function setDateDeParution(?\DateTimeInterface $date_de_parution): self
    {
        $this->date_de_parution = $date_de_parution;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getNbPages(): ?int
    {
        return $this->nb_pages;
    }

    public function setNbPages(?int $nb_pages): self
    {
        $this->nb_pages = $nb_pages;

        return $this;
    }
}
