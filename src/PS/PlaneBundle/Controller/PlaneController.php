<?php

namespace PS\PlaneBundle\Controller;

use FOS\RestBundle\View\View;
use PS\PlaneBundle\Entity\Plane;
use PS\PlaneBundle\Exception\NotEnoughFuelException;
use PS\PlaneBundle\Form\LocationType;
use PS\PlaneBundle\Form\PlaneType;
use PS\PlaneBundle\Model\Location;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlaneController extends Controller
{
    /**
     * Create a new plane.
     *
     * @Route("/planes")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $plane = new Plane();
        $planeForm = $this->createForm(new PlaneType(), $plane);

        $planeForm->submit($request);
        if (!$planeForm->isValid()) {

            $formErrors = $this->getFormErrorMessage($planeForm);

            return new Response(
                empty($formErrors['error']) ? "" : json_encode($formErrors),
                Response::HTTP_BAD_REQUEST,
                array('Content-Type' => 'application/json')
            );
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($plane);
        $em->flush();

        return new Response(
            json_encode($plane->toArray()),
            Response::HTTP_CREATED,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Move a plane to a new location and returns it.
     *
     * @Route("/plane/{id}/travel")
     * @Method({"POST"})
     */
    public function travelAction(Request $request, $id)
    {
        // TODO
    }

    /**
     * Util function to get the form error message
     */
    private function getFormErrorMessage(Form $form)
    {
        return array(
            'error' => (string) $form->getErrors(true, false)
        );
    }
}
