<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\my_module\Repository\ArticleRepository;
use Drupal\Tests\node\Traits\NodeCreationTrait;

class ArticleRepositoryTest extends EntityKernelTestBase {

  use NodeCreationTrait;

  public static $modules = ['node', 'my_module'];

  /** @test */
  public function it_returns_blog_posts() {
    $this->createNode(['type' => 'article', 'title' => 'Test post'])->save();

    $repository = $this->container->get(ArticleRepository::class);
    $articles = $repository->getAll();

    $this->assertCount(1, $articles);
  }

}
