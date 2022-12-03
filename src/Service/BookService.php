<?php

namespace App\Service;

use App\Entity\Book;
use App\Exception\BookCategoryNotFoundException;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Repository\BookCategoryRepository;
use App\Repository\BookRepository;
use Psr\Log\LoggerInterface;

class BookService {

  public function __construct(private BookRepository $bookRepository, private BookCategoryRepository $bookCategoryRepository) {}

  public function getBooksByCategory(int $categoryId): BookListResponse {

    $category = $this->bookCategoryRepository->find($categoryId);
    if ($category == null) {
      throw new BookCategoryNotFoundException();
    }

    $booksArrayByCategory = $this->bookRepository->findBookByCategoryId($categoryId);

    $booksModels = array_map(
      fn(Book $book) => (new BookListItem())
            ->setId(              $book->getId()              )
            ->setTitle(           $book->getTitle()           )
            ->setSlug(            $book->getSlug()            )
            ->setImage(           $book->getImage()           )
            ->setAuthors(         $book->getAuthors()         )
            ->setMeap(            $book->getMeap()            )
            ->setPublicationData( $book->getpublicationDate() ),
      $booksArrayByCategory
    );

    return new BookListResponse($booksModels);
  }
}
