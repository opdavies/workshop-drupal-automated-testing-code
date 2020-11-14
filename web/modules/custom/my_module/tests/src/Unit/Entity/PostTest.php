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

    $post = new Post($node);

    $this->assertSame('Test post', $post->getTitle());
  }

}
