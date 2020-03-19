<?php

namespace Drupal\Tests\my_module\Unit\Wrapper;

use Drupal\my_module\Wrapper\ArticleWrapper;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

class ArticleWrapperTest extends UnitTestCase {

  /** @test */
  public function it_can_return_the_article() {
    $article = $this->createMock(NodeInterface::class);

    $articleWrapper = new ArticleWrapper($article);

    $this->assertInstanceOf(NodeInterface::class, $articleWrapper->getOriginal());
    $this->assertSame(5, $articleWrapper->getOriginal()->id());
    $this->assertSame('article', $articleWrapper->getOriginal()->bundle());
  }

}

