<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController {

  public function __construct(private BookRepository $bookRepository) {}

  #[Route('/conference', name: 'app_conference')]
  public function index(LoggerInterface $logger): Response {
    $books = $this->bookRepository->findAll();
    $logger->info('<br>                                                  <br>');
    $logger->info('<br>               что то логируем                    <br>');
    $logger->info('<br>                                                  <br>');
    return $this->json($books);
  }
}
