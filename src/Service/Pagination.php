<?php
namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class Pagination
{
    private $paginator;

    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    public function paginateItem($page ,$itemList): PaginationInterface {
        
        return $this->paginator->paginate(
            $itemList,
            $page,
            8
        );
    }

}
