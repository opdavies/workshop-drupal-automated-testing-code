<?php

namespace Drupal\my_module\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

class ArticleRepository {

  /**
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  private $nodeStorage;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->nodeStorage = $entityTypeManager->getStorage('node');
  }

  public function getAll(): array {
    return $this->nodeStorage->loadByProperties([
      'status' => NodeInterface::PUBLISHED,
      'type' => 'article',
    ]);
  }

}

