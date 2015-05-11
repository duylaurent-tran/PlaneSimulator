<?php

namespace PS\PlaneBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use PS\PlaneBundle\Event\LandingEvent;
use PS\PlaneBundle\Exception\NotEnoughFuelException;
use PS\PlaneBundle\Model\Location;
use PS\PlaneBundle\Model\PlaneInterface;
use PS\PlaneBundle\PlaneEvents;
use PS\PlaneBundle\Services\PlaneTravelServiceInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PlaneTravelService implements PlaneTravelServiceInterface
{
    /**
     * Caculate the distance two points
     *
     * @param Location $begin coordinates of start point
     * @param Location $target coordinates of target point

     * @return float Distance between points
     *
     */
    private function calculate2dDistance($begin, $target)
    {
        return sqrt(pow(($target->getX() - $begin->getX()), 2) + pow(($target->getY() - $begin->getY()), 2));
    }

    /**
     * {@inheritdoc}
     */
    public function travel(PlaneInterface $plane, Location $target)
    {
        echo $this->calculate2dDistance($plane->getCurrentLocation(), $target);die();
        // Hint for exercise 3: use the method findOneByLocation()
        // on the AirportRepository
    }
}
