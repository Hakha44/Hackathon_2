<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 19/12/18
 * Time: 18:11
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Event;
use App\Entity\Subservice;


class FakerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($a = 0; $a < 5; $a++) {
            for ($i = 0; $i < 10; $i++) {
                $event = new Event();
                $event->setName($faker->sentence);
                $event->setDate($faker->dateTimeBetween('-1 month', '+1 years'));
                $manager->persist($event);
                $event->setSubservice($this->getReference('subservice_' . $a));
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SubserviceFixtures::class];
    }
}