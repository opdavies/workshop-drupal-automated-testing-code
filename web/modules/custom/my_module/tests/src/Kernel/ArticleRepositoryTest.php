<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\my_module\Repository\ArticleRepository;

class ArticleRepositoryTest extends EntityKernelTestBase {

  public static $modules = ['my_module'];

  /** @test */
  public function it_returns_blog_posts() {
    $repository = $this->container->get(ArticleRepository::class);
    $articles = $repository->getAll();

    $this->assertCount(1, $articles);
  }

}
