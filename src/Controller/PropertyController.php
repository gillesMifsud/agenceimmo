<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController {


    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
//        $property = new Property();
//        $property->setTitle('Mon premier bien')
//            ->setPrice(200000)
//            ->setRooms(4)
//            ->setBedrooms(3)
//            ->setDescription('Ma premiere description')
//            ->setSurface(120)
//            ->setFloor(4)
//            ->setHeat(1)
//            ->setCity('Strasbourg')
//            ->setAddress('15 Avenue des Vosges')
//            ->setPostalCode('67000');
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($property);
//        $em->flush();

//        $property = $this->repository->findAllVisible();
//        dump($property);

        $properties = $repository->findAllVisible();
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @param string $slug
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) { // If user try to change url, prevent with redirect to current slug
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }

}