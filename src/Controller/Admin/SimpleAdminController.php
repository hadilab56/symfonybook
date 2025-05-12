<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/simple')]
class SimpleAdminController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_admin_simple_dashboard')]
    public function dashboard(): Response
    {
        // Try to get count using both repository and direct SQL
        $ormBookCount = $this->entityManager->getRepository(Book::class)->count([]);
        $userCount = $this->entityManager->getRepository(User::class)->count([]);
        
        // Direct SQL query to count books
        $conn = $this->entityManager->getConnection();
        $sql = 'SELECT COUNT(*) as book_count FROM books'; // Using 'books' table instead of 'book'
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $result = $resultSet->fetchAssociative();
        $rawBookCount = $result['book_count'] ?? 0;

        return $this->render('admin/simple/dashboard.html.twig', [
            'bookCount' => $rawBookCount, // Use the raw count from direct SQL
            'userCount' => $userCount,
        ]);
    }

    #[Route('/books', name: 'app_admin_simple_books')]
    public function books(): Response
    {
        // Try to get books using the repository method
        $books = $this->entityManager->getRepository(Book::class)->findAll();
        
        // Try a direct SQL query to check if books exist in the database
        $conn = $this->entityManager->getConnection();
        $sql = 'SELECT * FROM books'; // Using 'books' table instead of 'book'
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $rawBooks = $resultSet->fetchAllAssociative();
        
        return $this->render('admin/simple/books.html.twig', [
            'books' => $books,
            'rawBooks' => $rawBooks
        ]);
    }

    #[Route('/users', name: 'app_admin_simple_users')]
    public function users(): Response
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/simple/users.html.twig', [
            'users' => $users,
        ]);
    }
}
