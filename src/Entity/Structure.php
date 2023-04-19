<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Structure
 *
 * @ORM\Table(name="structure")
 * @ORM\Entity
 * @ApiResource(normalizationContext={"groups"={"structure"}})
 * 
 * @ApiFilter(BooleanFilter::class, properties={"estasso"})
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={"nom": "partial", "ville": "exact"})
 */
class Structure
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
     * @var string
     *
     * @ORM\Column(name="NOM", type="string", length=100, nullable=false)
     * @Groups({"structure", "secStruct"})
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="RUE", type="string", length=200, nullable=false)
     * @NotNull(message="Rue doit être renseignée")
     */
    private $rue;

    /**
     * @var string
     * 
     * @ORM\Column(name="CP", type="string", length=5, nullable=false)
     * @Groups({"structure"})
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="VILLE", type="string", length=100, nullable=false)
     * @Groups({"structure"})
     */
    private $ville;

    /**
     * @var bool
     *
     * @ORM\Column(name="ESTASSO", type="boolean", nullable=false)
     * @Groups({"structure"})
     */
    private $estasso;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NB_DONATEURS", type="integer", nullable=true, options={"default"="NULL"})
     * @Groups({"structure"})
     */
    private $nbDonateurs = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NB_ACTIONNAIRES", type="integer", nullable=true, options={"default"="NULL"})
     * @Groups({"structure"})
     */
    private $nbActionnaires = NULL;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="SecteursStructures", mappedBy="idStructure")
     * @Groups({"structure"})
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function isEstasso(): ?bool
    {
        return $this->estasso;
    }

    public function setEstasso(bool $estasso): self
    {
        $this->estasso = $estasso;

        return $this;
    }

    public function getNbDonateurs(): ?int
    {
        return $this->nbDonateurs;
    }

    public function setNbDonateurs(?int $nbDonateurs): self
    {
        $this->nbDonateurs = $nbDonateurs;

        return $this;
    }

    public function getNbActionnaires(): ?int
    {
        return $this->nbActionnaires;
    }

    public function setNbActionnaires(?int $nbActionnaires): self
    {
        $this->nbActionnaires = $nbActionnaires;

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
            $secteursStructure->setIdStructure($this);
        }

        return $this;
    }

    public function removeSecteursStructure(SecteursStructures $secteursStructure): self
    {
        if ($this->secteursStructures->removeElement($secteursStructure)) {
            // set the owning side to null (unless already changed)
            if ($secteursStructure->getIdStructure() === $this) {
                $secteursStructure->setIdStructure(null);
            }
        }

        return $this;
    }


}
