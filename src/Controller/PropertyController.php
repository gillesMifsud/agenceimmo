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
     * @return Response
     */
    public function index(): Response
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

        return $this->render('pages/property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

}