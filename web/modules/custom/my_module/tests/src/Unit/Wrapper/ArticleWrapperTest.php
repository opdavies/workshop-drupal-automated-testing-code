<?php

namespace Drupal\Tests\my_module\Unit\Wrapper;

use Drupal\Component\Datetime\Time;
use Drupal\Component\Datetime\TimeInterface;
use Drupal\my_module\Wrapper\ArticleWrapper;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

class ArticleWrapperTest extends UnitTestCase {

  private $time;

  protected function setUp() {
    parent::setUp();

    $this->time = $this->createMock(Time::class);
  }

  /** @test */
  public function it_can_return_the_article() {
    $article = $this->createMock(NodeInterface::class);
    $article->method('id')->willReturn(5);
    $article->method('bundle')->willReturn('article');

    $articleWrapper = $this->createArticleWrapper($article);

    $this->assertInstanceOf(NodeInterface::class, $articleWrapper->getOriginal());
    $this->assertSame(5, $articleWrapper->getOriginal()->id());
    $this->assertSame('article', $articleWrapper->getOriginal()->bundle());
  }

  /** @test */
  public function it_throws_an_exception_if_the_node_is_not_an_article() {
    $this->expectException(\InvalidArgumentException::class);

    $page = $this->createMock(NodeInterface::class);
    $page->method('bundle')->willReturn('page');

    $articleWrapper = $this->createArticleWrapper($page);
  }

  /**
   * @test
   * @dataProvider articleCreatedDateProvider
   */
  public function articles_created_less_than_3_days_ago_are_not_publishable(
    string $offset,
    bool $expected
  ) {
    $this->time->method('getRequestTime')->willReturn(
      (new \DateTime())->getTimestamp()
    );

    $article = $this->createMock(NodeInterface::class);
    $article->method('bundle')->willReturn('article');

    $article->method('getCreatedTime')->willReturn(
      (new \DateTime())->modify($offset)->getTimestamp()
    );

    $articleWrapper = $this->createArticleWrapper($article);

    $this->assertSame($expected, $articleWrapper->isPublishable());
  }

  public function articleCreatedDateProvider() {
    return [
      ['-1 day', FALSE],
      ['-2 days 59 minutes', FALSE],
      ['-3 days', TRUE],
      ['-1 week', TRUE],
    ];
  }

  private function createArticleWrapper(NodeInterface $article): ArticleWrapper {
    return new ArticleWrapper($this->time, $article);
  }

}

