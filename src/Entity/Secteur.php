<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Symfony\Component\Validator\Constraints\NotBlank;


/**
 * Secteur
 *
 * @ORM\Table(name="secteur", uniqueConstraints={@ORM\UniqueConstraint(name="secteur_uq", columns={"LIBELLE"})})
 * @ORM\Entity
 * @ApiResource
 * @ApiFilter(RangeFilter::class, properties={"id"})
 */
class Secteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @NotBlank(message="Libellé non renseigné")
     * @ORM\Column(name="LIBELLE", type="string", length=100, nullable=false)
     */
    private $libelle;

    /**
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="SecteursStructures", mappedBy="idSecteur")
     */
    private $secteursStructures;

    public function __construct()
    {
        $this->secteursStructures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, SecteursStructures>
     */
    public function getSecteursStructures(): Collection
    {
        return $this->secteursStructures;
    }

    public function addSecteursStructure(SecteursStructures $secteursStructure): self
    {
        if (!$this->secteursStructures->contains($secteursStructure)) {
            $this->secteursStructures->add($secteursStructure);
            $secteursStructure->setIdSecteur($this);
        }

        return $this;
    }

    public function removeSecteursStructure(SecteursStructures $secteursStructure): self
    {
        if ($this->secteursStructures->removeElement($secteursStructure)) {
            // set the owning side to null (unless already changed)
            if ($secteursStructure->getIdSecteur() === $this) {
                $secteursStructure->setIdSecteur(null);
            }
        }

        return $this;
    }


}
