<?php

namespace App\Controller;

use App\Entity\BookletPeriod;
use App\Form\BookletPeriodFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class BookletPeriodController extends AbstractController
{
    #[Route('/booklet/period/{id}', name: 'app_booklet_period')]
    public function index(Request $request, EntityManagerInterface $em, BookletPeriod $bookletPeriod): Response
    {
        $form = $this->createForm(BookletPeriodFormType::class, $bookletPeriod);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($bookletPeriod);
            $em->flush();

            return $this->redirectToRoute('app_booklet_period', ['id' => $bookletPeriod->getId()]);
        }

        return $this->render('booklet_period/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
