<?php

namespace Drupal\Tests\my_module\Unit\Wrapper;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\my_module\Wrapper\ArticleWrapper;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

class ArticleWrapperTest extends UnitTestCase {

  /** @test */
  public function it_can_return_the_article() {
    $article = $this->createMock(NodeInterface::class);
    $article->method('id')->willReturn(5);
    $article->method('bundle')->willReturn('article');

    $time = $this->createMock(TimeInterface::class);
    $articleWrapper = new ArticleWrapper($time, $article);

    $this->assertInstanceOf(NodeInterface::class, $articleWrapper->getOriginal());
    $this->assertSame(5, $articleWrapper->getOriginal()->id());
    $this->assertSame('article', $articleWrapper->getOriginal()->bundle());
  }

  /** @test */
  public function it_throws_an_exception_if_the_node_is_not_an_article() {
    $this->expectException(\InvalidArgumentException::class);

    $page = $this->createMock(NodeInterface::class);
    $page->method('bundle')->willReturn('page');

    $time = $this->createMock(TimeInterface::class);
    new ArticleWrapper($time, $page);
  }

  /**
   * @test
   * @dataProvider articleCreatedDateProvider
   */
  public function articles_created_less_than_3_days_ago_are_not_publishable(
    string $offset,
    bool $expected
  ) {
    $time = $this->createMock(TimeInterface::class);

    $time->method('getRequestTime')->willReturn(
      (new \DateTime())->getTimestamp()
    );

    $article = $this->createMock(NodeInterface::class);
    $article->method('bundle')->willReturn('article');

    $article->method('getCreatedTime')->willReturn(
      (new \DateTime())->modify($offset)->getTimestamp()
    );

    $articleWrapper = new ArticleWrapper($time, $article);

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

}

