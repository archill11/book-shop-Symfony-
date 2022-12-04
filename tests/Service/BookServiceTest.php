<?php

namespace App\Tests\Service;

use App\Entity\BookCategory;
use App\Exception\BookCategoryNotFoundException;
use App\Model\BookCategoryListItem;
use App\Model\BookCategoryListResponse;
use App\Repository\BookCategoryRepository;
use App\Repository\BookRepository;
use App\Service\BookCategoryService;
use App\Service\BookService;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;


class BookServiceTest extends TestCase {

  public function testGetBookByCategoryNotFound(): void {
    $bookRepository = $this->createMock(BookRepository::class);
    $bookCategoryRepository = $this->createMock(BookCategoryRepository::class);

    $bookCategoryRepository->expects($this->once())
            ->method('find')
            ->with(130)
            ->willThrowException(new BookCategoryNotFoundException());

    $this->expectException(BookCategoryNotFoundException::class);

    (new BookService($bookRepository, $bookCategoryRepository))->getBooksByCategory(130);
  }
}
