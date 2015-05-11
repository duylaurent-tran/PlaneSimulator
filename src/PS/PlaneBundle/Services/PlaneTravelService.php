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
     * @param int $x1 abscisse coordinate of start point
     * @param int $y1 ordinate coordinate of start point
     * @param int $x2 abscisse of target point
     * @param int $y2 ordinate of target point

     * @return float Distance between points
     *
     */
    private function calculate2dDistance($x1, $y1, $x2, $y2)
    {
        return sqrt(pow(($x2 - $x1), 2) + pow(($y2 - $y1), 2));
    }

    /**
     * {@inheritdoc}
     */
    public function travel(PlaneInterface $plane, Location $target)
    {

    }
}
