<?php

namespace App\Controller;

use App\Form\LocationType;
use App\Service\ManageBreweryVisits;
use App\Service\ManageTravelData;
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
     * @param ManageBreweryVisits $manageBreweryVisits
     * @param ManageTravelData $manageTravelData
     *
     * @return Response
     */
    public function index(Request $request, ManageBreweryVisits $manageBreweryVisits, ManageTravelData $manageTravelData): Response
    {
        $formData = [
            // Bad Frankenhausen, Germany
            'latitude' => 51.35546800,
            'longitude' => 11.10079000,

            // Lodz
            /*'latitude' => 51.74250300,
            'longitude' => 19.43295600,*/
        ];

        $form = $this->createForm(LocationType::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
        }

        // Load travel data
        $travelData = $manageTravelData->loadTravelDataByCoordinates($formData);

        // Get breweries, beer types
        $data = $manageBreweryVisits->breweryVisits($travelData, $formData);

        return $this->render('beer/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data,
        ]);
    }
}
