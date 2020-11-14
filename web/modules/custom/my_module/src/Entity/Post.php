<?php

namespace Drupal\my_module\Entity;

use Drupal\node\NodeInterface;

class Post {

  private $node;

  public function __construct(NodeInterface $node) {
    if ($node->bundle() != 'article') {
      throw new \InvalidArgumentException();
    }

    $this->node = $node;
  }

  public function getTitle(): string {
    return $this->node->label();
  }

}
