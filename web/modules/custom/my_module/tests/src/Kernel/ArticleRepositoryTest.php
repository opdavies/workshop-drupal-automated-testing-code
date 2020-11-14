<?php

namespace Drupal\Tests\my_module\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\my_module\Repository\ArticleRepository;
use Drupal\node\NodeInterface;
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
    $this->assertIsObject($articles[1]);
    $this->assertInstanceOf(NodeInterface::class, $articles[1]);
    $this->assertSame('article', $articles[1]->bundle());
    $this->assertSame('Test post', $articles[1]->label());
  }

  protected function setUp() {
    parent::setUp();

    $this->installConfig(['filter']);

    $this->installSchema('node', ['node_access']);
  }

}
