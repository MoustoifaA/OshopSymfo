<?php
namespace App\Service;

use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\TypeRepository;

class NavList
{
    private $brandRepo;
    private $typeRepo;
    private $categoryRepo;

    public function __construct(BrandRepository $brandRepo, TypeRepository $typeRepo, CategoryRepository $categoryRepo)
    {
        $this->brandRepo = $brandRepo;
        $this->typeRepo = $typeRepo;
        $this->categoryRepo = $categoryRepo;
    }
    public function getBrand()
    {
        return $this->brandRepo->findAll();
    }
    public function getType()
    {
        return $this->typeRepo->findAll();
    }
    public function getCategory()
    {
        return $this->categoryRepo->findAll();
    }
}
