<?php
namespace App\Foundations\Pagination;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as PaginatorContract;
use Illuminate\Contracts\Pagination\Presenter as PresenterContract;
use Illuminate\Pagination\BootstrapThreeNextPreviousButtonRendererTrait;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Pagination\UrlWindowPresenterTrait;
use Illuminate\Support\HtmlString;


/**
 *
 * {!! with(new App\Foundations\Pagination\CustomerPresenter($data))->render() !!}
 */
class CustomerPresenter implements PresenterContract
{
    use BootstrapThreeNextPreviousButtonRendererTrait, UrlWindowPresenterTrait;

    protected $paginator;

    protected $window;

    /**
     * Create a new Bootstrap presenter instance.
     *
     * @param IlluminateContractsPaginationPaginator|PaginatorContract $paginator
     * @param IlluminatePaginationUrlWindow|UrlWindow|null $window
     */
    public function __construct(PaginatorContract $paginator, UrlWindow $window = null)
    {
        $this->paginator = $paginator;
        $this->window = is_null($window) ? UrlWindow::make($paginator) : $window->get();
    }

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages();
    }

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return IlluminateSupportHtmlString
     */
    public function render()
    {
        if ($this->hasPages()) {
            return new HtmlString(sprintf(
                '<div class="wp-pagenavi">%s %s %s</div>',
                $this->getPreviousButton('上一页'),//具体实现可以查看该方法
                $this->getLinks(),
                $this->getNextButton('下一页')//具体实现可以查看该方法
            ));
        }

        return '';
    }

    /**
     * Get HTML wrapper for an available page link.
     *
     * @param string $url
     * @param int $page
     * @param string|null $rel
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="' . $rel . '"';

        return '<a class="smaller page" href="' . htmlentities($url) . '"' . $rel . '>' . $page . '</a>';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        // return '<a class="disabled ">' . $text . '</a>';
        return '';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<span class="current">' . $text . '</span>';
    }

    /**
     * Get a pagination"dot"element.
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('...');
    }

    /**
     * Get the current page from the paginator.
     *
     * @return int
     */
    protected function currentPage()
    {
        return $this->paginator->currentPage();
    }

    /**
     * Get the last page from the paginator.
     *
     * @return int
     */
    protected function lastPage()
    {
        return $this->paginator->lastPage();
    }

}