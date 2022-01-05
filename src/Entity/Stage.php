<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="stages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idEntreprise;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="formations")
     */
    private $idFormation;


    public function __construct()
    {
        $this->idFormation = new ArrayCollection();
    }

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

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getIdEntreprise(): ?Entreprise
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(?Entreprise $idEntreprise): self
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getIdFormation(): Collection
    {
        return $this->idFormation;
    }

    public function addIdFormation(Formation $idFormation): self
    {
        if (!$this->idFormation->contains($idFormation)) {
            $this->idFormation[] = $idFormation;
        }

        return $this;
    }

    public function removeIdFormation(Formation $idFormation): self
    {
        $this->idFormation->removeElement($idFormation);

        return $this;
    }

}
