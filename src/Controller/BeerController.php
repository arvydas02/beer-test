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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $formData = [
            'latitude' => 51.35546800,
            'longitude' => 11.10079000,
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
