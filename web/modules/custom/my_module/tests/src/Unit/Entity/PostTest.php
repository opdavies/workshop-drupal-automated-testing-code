<?php

namespace Drupal\Tests\my_module\Unit\Entity;

use Drupal\my_module\Entity\Post;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

class PostTest extends UnitTestCase {

  /** @test */
  public function it_returns_the_title() {
    $node = $this->createMock(NodeInterface::class);

    $node->expects($this->once())
      ->method('label')
      ->willReturn('Test post');
    $node->method('bundle')->willReturn('article');

    $post = new Post($node);

    $this->assertSame('Test post', $post->getTitle());
  }

  /** @test */
  public function it_throws_an_exception_if_the_node_is_not_an_article() {
    $node = $this->createMock(NodeInterface::class);

    $node->method('bundle')->willReturn('page');

    $this->expectException(\InvalidArgumentException::class);

    new Post($node);
  }

}
