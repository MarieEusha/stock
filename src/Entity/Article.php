<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;    
/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @Groups("article")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=75)
     * @Assert\Length(min=3, max=75, minMessage="Le nom de l'article est trop court")
     */
    private $label;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $ref;

    /**
     * @Groups("toto")
     * @ORM\OneToMany(targetEntity=Stored::class, mappedBy="articles")
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function setRef(int $ref): self
    {
        $this->ref = $ref;

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
            $storedList->setArticles($this);
        }

        return $this;
    }

    public function removeStoredList(Stored $storedList): self
    {
        if ($this->storedList->contains($storedList)) {
            $this->storedList->removeElement($storedList);
            // set the owning side to null (unless already changed)
            if ($storedList->getArticles() === $this) {
                $storedList->setArticles(null);
            }
        }

        return $this;
    }
}
