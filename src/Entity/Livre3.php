<?php

namespace App\Entity;

use App\Repository\Livre3Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Livre3Repository::class)]
class Livre3
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
