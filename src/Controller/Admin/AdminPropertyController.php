<?php

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/", name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/property/create", name="admin.property.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property); // Property will be tracked from the entity manager which will do the changes
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/edit/{id}", name="admin.property.edit")
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
}