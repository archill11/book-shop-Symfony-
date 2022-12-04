<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Book::class);
  }

  public function save(Book $entity, bool $flush = false): void {
    $this->getEntityManager()->persist($entity); // сохранить $entity

    if ($flush) {
      $this->getEntityManager()->flush(); // выполнить команду к БД
    }
  }

  public function remove(Book $entity, bool $flush = false): void {
    $this->getEntityManager()->remove($entity);
    
    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function findBookByCategoryId(int $id): array {
    $query = $this->_em->createQuery(
      'SELECT b 
      FROM App\Entity\Book b 
      WHERE :categoryId 
      MEMBER OF b.categories'
    );
    $query->setParameter('categoryId', $id);
    return $query->getResult();
  }

}
