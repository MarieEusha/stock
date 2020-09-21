<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StorageRepository::class)
 */
class Storage
{
    /**
     * @Groups("storage")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=75)
     */
    private $label;

    /**
     * @Groups("toto")
     * @ORM\OneToMany(targetEntity=Stored::class, mappedBy="storages",cascade={"persist"})
     */
    private $storedList;

    public function __construct()
    {
        $this->storedList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Stored[]
     */
    public function getStoredList(): Collection
    {
        return $this->storedList;
    }

    public function addStoredList(Stored $storedList): self
    {
        if (!$this->storedList->contains($storedList)) {
            $this->storedList[] = $storedList;
            $storedList->setStorages($this);
        }

        return $this;
    }

    public function removeStoredList(Stored $storedList): self
    {
        if ($this->storedList->contains($storedList)) {
            $this->storedList->removeElement($storedList);
            // set the owning side to null (unless already changed)
            if ($storedList->getStorages() === $this) {
                $storedList->setStorages(null);
            }
        }

        return $this;
    }
}
