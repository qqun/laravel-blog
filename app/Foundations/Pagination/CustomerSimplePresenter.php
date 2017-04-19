<?php
namespace App\Foundations\Pagination;


use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Support\HtmlString;


/*
 *
 * {!! with(new AppFoundationsPaginationCustomerSimplePresenter($categories))->render() !!}
 *
 */

class CustomerSimplePresenter extends CustomerPresenter
{
    /**
     * Create a simple Bootstrap 3 presenter.
     *
     * @param IlluminateContractsPaginationPaginator|PaginatorContract $paginator
     */
    public function __construct(PaginatorContract $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages() && count($this->paginator->items()) > 0;
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
                '<ul class="pager">%s %s</ul>',
                $this->getPreviousButton('上一篇'),
                $this->getNextButton('下一篇')
            ));
        }

        return '';
    }

}