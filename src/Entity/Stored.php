<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StoredRepository;
use Doctrine\ORM\Mapping\GeneratedValue;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StoredRepository::class)
 * @ORM\Table(name="`stored`")
 */
class Stored
{
    /**
     * @Groups("stored")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @Groups("stored")
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="storedList")
     */
    private $articles;

    /**
     * @Groups("titi")
     * @ORM\ManyToOne(targetEntity=Storage::class, inversedBy="storedList")
     */
    private $storages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getArticles(): ?Article
    {
        return $this->articles;
    }

    public function setArticles(?Article $articles): self
    {
        $this->articles = $articles;

        return $this;
    }

    public function getStorages(): ?Storage
    {
        return $this->storages;
    }

    public function setStorages(?Storage $storages): self
    {
        $this->storages = $storages;

        return $this;
    }
}
