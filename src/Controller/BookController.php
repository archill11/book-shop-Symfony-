<?php

namespace App\Controller;

use App\Exception\BookCategoryNotFoundException;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\BookListResponse;
use App\Model\ErrorResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BookService;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BookController extends AbstractController {
  public function __construct(private BookService $bookService) {} // инжектируем сервис в контроллер


    /**
   * @OA\Response(
   *     response=200,
   *     description="Returns published books inside a category",
   *     @Model(type=BookListResponse::class)
   * )
   * @OA\Response(
   *     response=404,
   *     description="book category not found",
   *     @Model(type=ErrorResponse::class)
   * )
   */
  #[Route(path: '/api/v1/category/{categoryId}/books', methods: ['GET'])]
  public function BooksByCategory(int $categoryId): Response {
    
    return $this->json($this->bookService->getBooksByCategory($categoryId));
  }
}
