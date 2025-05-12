<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table(name: '`books`')]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    // Removed roles field as it doesn't exist in the database

    #[ORM\Column(type: "string", length: 255)]
    private ?string $author = null;

    // Removed description field as it doesn't exist in the database
    
    #[ORM\Column(type: "float", nullable: true)]
    private ?float $price = null;
    
    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private ?string $isbn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    // Removed getRoles and setRoles methods as the roles field doesn't exist

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    // Removed getDescription and setDescription methods as the description field doesn't exist
    
    public function getPrice(): ?float
    {
        return $this->price;
    }
    
    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }
    
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }
    
    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;
        return $this;
    }
}
