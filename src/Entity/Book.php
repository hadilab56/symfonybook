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
    private $id;

    #[ORM\Column(length: 255)]
    private $title;

    // Removed roles field as it doesn't exist in the database

    #[ORM\Column(type: "string", length: 255)]

    private $author;

    // Removed description field as it doesn't exist in the database
    
    #[ORM\Column(type: "float", nullable: true)]
    private $price;
    
    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private $isbn;
public function getId(): ?int { return $this->id; }

    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }

    public function getAuthor(): ?string { return $this->author; }
    public function setAuthor(string $author): self { $this->author = $author; return $this; }

    public function getPrice(): ?string { return $this->price; }
    public function setPrice(?string $price): self { $this->price = $price; return $this; }

    public function getIsbn(): ?string { return $this->isbn; }
    public function setIsbn(?string $isbn): self { $this->isbn = $isbn; return $this; }
}
