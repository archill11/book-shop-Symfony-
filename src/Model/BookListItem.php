<?php

namespace App\Model;

use DateTimeInterface;

class BookListItem {

  private int $id;

  private string $title;

  private string $image;

  private string $slug;

  /** @var string[] */
  private array $authors;

  private bool $meap;

  private DateTimeInterface $publicationData;




  //--------------------- getters & setters
  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  public function getAuthors() {
    return $this->authors;
  }

  public function setAuthors($authors) {
    $this->authors = $authors;
    return $this;
  }

  public function getImage() {
    return $this->image;
  }

  public function setImage($image) {
    $this->image = $image;
    return $this;
  }

  public function getMeap() {
    return $this->meap;
  }

  public function setMeap($meap) {
    $this->meap = $meap;

    return $this;
  }

  public function getPublicationData() {
    return $this->publicationData;
  }

  public function setPublicationData($publicationData) {
    $this->publicationData = $publicationData;
    return $this;
  }
  
    public function getSlug() {
      return $this->slug;
    }
  
    public function setSlug($slug) {
      $this->slug = $slug;
  
      return $this;
    }
  ///////////////////////////////////////////

}
