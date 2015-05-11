<?php

namespace PS\PlaneBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use PS\PlaneBundle\Event\LandingEvent;
use PS\PlaneBundle\Exception\NotEnoughFuelException;
use PS\PlaneBundle\Model\Location;
use PS\PlaneBundle\Model\PlaneInterface;
use PS\PlaneBundle\PlaneEvents;
use PS\PlaneBundle\Services\PlaneTravelServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PlaneTravelService implements PlaneTravelServiceInterface
{
    const NOT_ENOUGH_FUEL = 'The plane does not have enough fuel to get to destination';

    /**
     * Calculate the remaining fuel to get to destination
     *
     * @param int $currentFuel the current fuel of the plane
     * @param int $distance the distance to get to destination
     * @param int $fuelPerDistanceUnit the fuel used by the plane by distance unit
     *
     * @return int return the remaining fuel
     *
     */
    private function calculateRemainingFuelToDestination($currentFuel, $distance, $fuelPerDistanceUnit = 1)
    {
        return  $currentFuel - $distance * $fuelPerDistanceUnit;
    }

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
        $distance = round($this->calculate2dDistance($plane->getCurrentLocation(), $target));
        $remainingFuel = $this->calculateRemainingFuelToDestination($plane->getRemainingFuel(), $distance);

        if ($remainingFuel < 0) {
            throw new NotEnoughFuelException(
                PlaneTravelService::NOT_ENOUGH_FUEL,
                Response::HTTP_BAD_REQUEST
            );
        }
        $plane->setCurrentLocation($target);
        $plane->setRemainingFuel($remainingFuel);
    }
}
