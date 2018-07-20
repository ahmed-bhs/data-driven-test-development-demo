<?php

namespace App\Controller\Team;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CreateController extends AbstractController
{
    public function index(Request $request)
    {
        $data = json_decode($request->getContent());

        $team = new Team;
        $team->setName($data->name);
        $team->setLocation($data->location);
        $team->setStadium($data->stadium);

        $em = $this->getDoctrine()->getManager();

        $em->persist($team);
        $em->flush();

        // ...
    }
}
