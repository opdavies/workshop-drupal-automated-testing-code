<?php

namespace Drupal\my_module\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class ArticleRepository {

  private $nodeStorage;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->nodeStorage = $entityTypeManager->getStorage('node');
  }

  public function getAll(): array {
    return $this->nodeStorage->loadMultiple();
  }

}
