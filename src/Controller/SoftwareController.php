<?php

namespace App\Controller;

use App\Entity\Software;
use App\Form\SoftwareType;
use App\Repository\SoftwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/software')]
class SoftwareController extends AbstractController
{
    #[Route("/", name: "software_index", methods: ["GET"])]
    public function index(SoftwareRepository $softwareRepository): Response
    {
        return $this->render('software/index.html.twig', [
            'softwares' => $softwareRepository->findAll(),
        ]);
    }

    #[Route("/new", name: "software_new", methods: ["GET","POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $software = new Software();
        $form = $this->createForm(SoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($software);
            $em->flush();

            if ( $request->query->has('s') == 'report') {
                return $this->redirectToRoute('intervention_report', [
                    'id' => $request->query->get('id'),
                ]);
            }

            return $this->redirectToRoute('software_index');
        }

        return $this->render('software/new.html.twig', [
            'software' => $software,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/{id}/edit", name: "software_edit", methods: ["GET","POST"])]
    public function edit(Request $request, Software $software, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('software_index');
        }

        return $this->render('software/edit.html.twig', [
            'software' => $software,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/{id}", name: "software_delete", methods: ["POST"])]
    public function delete(Request $request, Software $software, EntityManagerInterface $em): Response
    {
         $softwareId = $software->getId();

        if ($this->isCsrfTokenValid('delete' . $softwareId, $request->request->get('_token'))) {
            $em->remove($software);
            $em->flush();

            $this->addFlash('success', "Suppression du logiciel n°" . $softwareId . " réussie.");
        } else {
            $this->addFlash('error', "Échec de la suppression du logiciel n°" . $softwareId . ".");
        }

        return $this->redirectToRoute('software_index');
    }
}
