<?php

namespace App\Controller\Back;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Service\Pagination;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_back_category_browse', methods: ['GET'])]
    public function browse(CategoryRepository $categoryRepository, Pagination $pagination, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $categories = $pagination->paginateItem($page, $categoryRepository->findAll());

        return $this->render('back/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/add', name: 'app_back_category_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_category_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_category_read', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('back/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_back_category_browse', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_category_browse', [], Response::HTTP_SEE_OTHER);
    }
}
