<?php

namespace Drupal\my_module\Wrapper;

use Drupal\node\NodeInterface;

class ArticleWrapper {

  private $article;

  public function __construct(NodeInterface $node) {
    $this->article = $node;
  }

  public function getOriginal(): NodeInterface {
    return $this->article;
  }

}
