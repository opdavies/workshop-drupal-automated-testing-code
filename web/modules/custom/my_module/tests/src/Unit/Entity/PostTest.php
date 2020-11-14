<?php

namespace Drupal\Tests\my_module\Unit\Entity;

use Drupal\my_module\Entity\Post;
use Drupal\Tests\UnitTestCase;

class PostTest extends UnitTestCase {

  /** @test */
  public function it_returns_the_title() {
    $post = new Post();

    $this->assertSame('Test post', $post->getTitle());
  }

}
