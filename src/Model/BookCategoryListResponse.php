<?php

namespace App\Model;

class BookCategoryListResponse {

  /**
   * @var BookCategoryListItem[]
   */
  private array $items;

  public function __construct(array $items) {
    $this->items = $items;
  }
  
	public function getItems(): array {
		return $this->items;
	}
	

}
