<?php

namespace App\Controller;

use App\Entity\Book; // Import de l'entité Book
use Doctrine\ORM\EntityManagerInterface; // Import de l'EntityManager
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em; // Injection du gestionnaire d'entités
    }

    #[Route(path: '/livre', name: 'livre_index')]
    public function index(): Response
    {
        // Récupérer les livres depuis la base de données
        $books = $this->em->getRepository(Book::class)->findAll();

        return $this->render('livre/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/livre/add', name: 'livre_add')]
    public function addBook(): Response
    {
        $book = new Book();
        $book->setTitle('Nouveau Livre');
        $book->setAuthor('Auteur Exemple');
        $book->setPrice(19.99);
        $book->setIsbn('1234567890');

        $this->em->persist($book); // Ajouter le livre
        $this->em->flush(); // Sauvegarder dans la base de données

        return new Response('Livre ajouté avec succès !');
    }

    #[Route('/livre/delete/{id}', name: 'livre_delete')]
    public function deleteBook(int $id): Response
    {
        $book = $this->em->getRepository(Book::class)->find($id);

        if ($book) {
            $this->em->remove($book); // Supprimer le livre
            $this->em->flush();
            return new Response('Livre supprimé avec succès !');
        }

        return new Response('Livre introuvable !', 404);
    }

    #[Route('/livre/update/{id}', name: 'livre_update')]
    public function updateBook(int $id): Response
    {
        $book = $this->em->getRepository(Book::class)->find($id);

        if ($book) {
            $book->setTitle('Titre mis à jour');
            $book->setAuthor('Auteur mis à jour');
            $book->setPrice(29.99);
            $book->setIsbn('9876543210');

            $this->em->flush(); // Mettre à jour la base de données

            return new Response('Livre mis à jour avec succès !');
        }

        return new Response('Livre introuvable !', 404);
    }
}
