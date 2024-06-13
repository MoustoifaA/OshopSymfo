<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/catalog', name: 'app_catalog_')]
class CatalogController extends AbstractController
{
    #[Route('/type/{id}', methods:'GET', name: 'type', requirements:["id" => "\d+"])]
    public function type(Type $type): Response
    {
        $productList = $type->getProducts();

        return $this->render('catalog/type.html.twig', [
            'productList' => $productList,
            'type' => $type,
        ]);
    }
}
