<?php

namespace App\Controller;

use App\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends AbstractController
{
    /**
     * @Route("/", name="beer")
     */
    public function index( Request $request): Response
    {
        $formData = [
            'latitude' => 51.355468,
            'longitude' => 11.100790,
        ];

        $form = $this->createForm(LocationType::class, $formData);
        $form->handleRequest($request);

        $data = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
        }

        return $this->render('beer/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data,
        ]);
    }
}
