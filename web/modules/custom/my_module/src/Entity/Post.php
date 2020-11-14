<?php

namespace Drupal\my_module\Entity;

use Drupal\node\NodeInterface;

class Post {

  private $node;

  public function __construct(NodeInterface $node) {
    $this->node = $node;
  }

  public function getTitle(): string {
    return $this->node->label();
  }

}
