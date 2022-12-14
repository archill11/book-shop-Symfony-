<?php

namespace App\Controller;

use App\Service\BookCategoryService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Model\BookCategoryListResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class BookCategoryController extends AbstractController {
  public function __construct(private BookCategoryService $bookCategoryService) {} // инжектируем сервис в контроллер

  /**
   * @OA\Response(
   *     response=200,
   *     description="Returns book categories",
   *     @Model(type=BookCategoryListResponse::class)
   * )
   */
  #[Route(path: '/api/v1/book/categories', methods: ['GET'])]
  public function categories(): Response {
    return $this->json($this->bookCategoryService->getCategories());
  }
}
