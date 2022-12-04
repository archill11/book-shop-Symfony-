<?php

namespace App\Tests\Service;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Exception\BookCategoryNotFoundException;
use App\Model\BookCategoryListItem;
use App\Model\BookCategoryListResponse;
use App\Model\BookListItem;
use App\Repository\BookCategoryRepository;
use App\Repository\BookRepository;
use App\Service\BookCategoryService;
use App\Service\BookService;
use App\Tests\AbstractTestCase;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;


class BookServiceTest extends AbstractTestCase {

  public function testGetBookByCategoryNotFound(): void {
    $bookRepository = $this->createMock(BookRepository::class);
    $bookCategoryRepository = $this->createMock(BookCategoryRepository::class);

    $bookCategoryRepository->expects($this->once())
      ->method('existsById')
      ->with(130)
      ->willReturn(false);

    $this->expectException(BookCategoryNotFoundException::class);

    (new BookService($bookRepository, $bookCategoryRepository))->getBooksByCategory(130);
  }


  public function testGetBooksByCategoryNotFound(): void {
    $this->bookCategoryRepository->expects($this->once())
      ->method('existsById')
      ->with(130)
      ->willReturn(false);

    $this->expectException(BookCategoryNotFoundException::class);

    $this->createBookService()->getBooksByCategory(130);
  }


  private function createBookService(): BookService {
    return new BookService(
      $this->bookRepository,
      $this->bookCategoryRepository,
      $this->ratingService
    );
  }


  private function createBookEntity(): Book {
    $book = (new Book())
      ->setTitle('Test Book')
      ->setSlug('test-book')
      ->setMeap(false)
      ->setAuthors(['Tester'])
      ->setImage('http://localhost/test.png')
      ->setCategories(new ArrayCollection())
      ->setPublicationDate(new DateTime('2020-10-10'));

    $this->setEntityId($book, 123);

    return $book;
  }


  private function createBookItemModel(): BookListItem {
    return (new BookListItem())
      ->setId(123)
      ->setTitle('Test Book')
      ->setSlug('test-book')
      ->setMeap(false)
      ->setAuthors(['Tester'])
      ->setImage('http://localhost/test.png')
      ->setPublicationData(1602288000);
  }

  
}
