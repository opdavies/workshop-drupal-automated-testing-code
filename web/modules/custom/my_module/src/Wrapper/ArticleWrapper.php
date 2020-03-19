<?php

namespace Drupal\my_module\Wrapper;

use Drupal\node\NodeInterface;

class ArticleWrapper {

  private $article;

  public function __construct(NodeInterface $node) {
    $this->verifyNodeType($node);

    $this->article = $node;
  }

  public function getOriginal(): NodeInterface {
    return $this->article;
  }

  private function verifyNodeType(NodeInterface $node): void {
   if ($node->bundle() != 'article') {
     throw new \InvalidArgumentException(sprintf(
         '%s is not an article',
         $node->bundle()
       ));
    }
  }

}
