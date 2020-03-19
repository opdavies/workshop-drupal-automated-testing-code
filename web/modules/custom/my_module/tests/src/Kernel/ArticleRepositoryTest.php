<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\my_module\Repository\ArticleRepository;
use Drupal\Tests\node\Traits\NodeCreationTrait;

class ArticleRepositoryTest extends EntityKernelTestBase {

  use NodeCreationTrait;

  public static $modules = [
    'node',
    'my_module',
  ];

  protected function setUp() {
    parent::setUp();

    $this->installConfig([
      'filter',
    ]);

    $this->installSchema('node', ['node_access']);
  }

  /** @test */
  public function nodes_that_are_not_articles_are_not_returned() {
    $this->createNode(['type' => 'article'])->save();
    $this->createNode(['type' => 'article'])->save();
    $this->createNode(['type' => 'article'])->save();

    $repository = $this->container->get(ArticleRepository::class);
    $articles = $repository->getAll();

    $this->assertCount(3, $articles);
  }

}

