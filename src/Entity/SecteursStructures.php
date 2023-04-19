<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SecteursStructures
 *
 * @ApiResource(normalizationContext={"groups"={"secStruct"}})
 * @ORM\Table(name="secteurs_structures", uniqueConstraints={@ORM\UniqueConstraint(name="secteurs_structures_uq", columns={"ID_STRUCTURE", "ID_SECTEUR"})}, indexes={@ORM\Index(name="secteurs_structures_secteur_fk", columns={"ID_SECTEUR"}), @ORM\Index(name="IDX_ECF28C16355BC10D", columns={"ID_STRUCTURE"})})
 * @ORM\Entity
 */
class SecteursStructures
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"structure", "secStruct"})
     */
    private $id;

    /**
     * @var \Secteur
     * @ApiSubresource
     * @ORM\ManyToOne(targetEntity="Secteur", inversedBy="secteursStructures")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SECTEUR", referencedColumnName="ID")
     * })
     * @Groups({"structure", "secStruct"})
     * 
     */
    private $idSecteur;

    /**
     * @var \Structure
     * @ApiSubresource
     * @ORM\ManyToOne(targetEntity="Structure", inversedBy="secteursStructures")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_STRUCTURE", referencedColumnName="ID")
     * })
     * @Groups({"secStruct"})
     */
    private $idStructure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSecteur(): ?Secteur
    {
        return $this->idSecteur;
    }

    public function setIdSecteur(?Secteur $idSecteur): self
    {
        $this->idSecteur = $idSecteur;

        return $this;
    }

    public function getIdStructure(): ?Structure
    {
        return $this->idStructure;
    }

    public function setIdStructure(?Structure $idStructure): self
    {
        $this->idStructure = $idStructure;

        return $this;
    }


}
