<?php

namespace App\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriberRequest {

  #[Email]
  #[NotBlank]
  private string $email;

  #[IsTrue]
  #[NotBlank]
  private bool $agreed;

  public function __construct($email, $agreed) {
    if ($agreed == false) { return; }
    $this->email = $email;
    $this->agreed = $agreed;
  }

  //--------------------------- getters & setters
  public function getEmail(): string {
    return $this->email;
  }

  public function setEmail(string $email): void {
    $this->email = $email;
  }

  public function getAgreed() {
    return $this->agreed;
  }

  public function setAgreed(bool $agreed): void {
    $this->agreed = $agreed;
  }
  ///////////////////////////////////////////////

}
