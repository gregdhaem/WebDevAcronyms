<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="defintion", type="string", length=255, nullable=false)
     */
    private $defintion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDefintion(): ?string
    {
        return $this->defintion;
    }

    public function setDefintion(string $defintion): self
    {
        $this->defintion = $defintion;

        return $this;
    }

    public function __toString(){
        
        return $this->defintion;

    }


}
