<?php

namespace Drupal\my_module\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\my_module\Entity\Post;
use Drupal\node\NodeInterface;

class ArticleRepository {

  private $nodeStorage;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->nodeStorage = $entityTypeManager->getStorage('node');
  }

  public function getAll(): array {
    $articles = $this->nodeStorage->loadByProperties([
      'status' => NodeInterface::PUBLISHED,
      'type' => 'article',
    ]);

    $this->sortByCreatedDate($articles);

    return array_map(function (NodeInterface $node): Post {
      return new Post();
    }, $articles);
  }

  private function sortByCreatedDate(array &$articles): void {
    uasort($articles, function (NodeInterface $a, NodeInterface $b): bool {
      return $a->getCreatedTime() < $b->getCreatedTime();
    });
  }

}
