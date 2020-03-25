<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\my_module\Repository\ArticleRepository;
use Drupal\node\NodeInterface;
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
    $this->createNode(['type' => 'page'])->save();
    $this->createNode(['type' => 'article'])->save();
    $this->createNode(['type' => 'page'])->save();
    $this->createNode(['type' => 'article'])->save();

    $repository = $this->container->get(ArticleRepository::class);
    $articles = $repository->getAll();

    $this->assertCount(3, $articles);
  }

  /** @test */
  public function only_published_articles_are_returned() {
    $this->createNode(['type' => 'article', 'status' => NodeInterface::PUBLISHED])->save();
    $this->createNode(['type' => 'article', 'status' => NodeInterface::NOT_PUBLISHED])->save();
    $this->createNode(['type' => 'article', 'status' => NodeInterface::PUBLISHED])->save();
    $this->createNode(['type' => 'article', 'status' => NodeInterface::NOT_PUBLISHED])->save();
    $this->createNode(['type' => 'article', 'status' => NodeInterface::PUBLISHED])->save();

    $repository = $this->container->get(ArticleRepository::class);
    $articles = $repository->getAll();

    $this->assertCount(3, $articles);
  }

  /** @test */
  public function nodes_are_ordered_by_date_and_returned_newest_first() {
    $this->createNode(['type' => 'article', 'created' => (new DrupalDateTime('-2 days'))->getTimestamp()]);
    $this->createNode(['type' => 'article', 'created' => (new DrupalDateTime('-1 week'))->getTimestamp()]);
    $this->createNode(['type' => 'article', 'created' => (new DrupalDateTime('-1 hour'))->getTimestamp()]);
    $this->createNode(['type' => 'article', 'created' => (new DrupalDateTime('-1 year'))->getTimestamp()]);
    $this->createNode(['type' => 'article', 'created' => (new DrupalDateTime('-1 month'))->getTimestamp()]);

    $repository = $this->container->get(ArticleRepository::class);
    $nodes = $repository->getAll();
    $nodeIds = array_keys($nodes);

    $this->assertSame([3, 1, 2, 5, 4], $nodeIds);
  }

}

