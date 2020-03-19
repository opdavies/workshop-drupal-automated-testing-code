<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

class ArticleRepositoryTest extends EntityKernelTestBase {

  /** @test */
  public function nodes_that_are_not_articles_are_not_returned() {
    $repository = $this->container->get(ArticleRepository::class);
    $articles = $repository->getAll();

    $this->assertCount(3, $articles);
  }

}

