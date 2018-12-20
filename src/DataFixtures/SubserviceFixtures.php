<?php

namespace App\DataFixtures;

use App\Entity\Subservice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SubserviceFixtures extends Fixture implements DependentFixtureInterface
{
    const CONST_SUBSERVICE = [
        'Atelier',
        'Permanences Experts',
        'Partenaires du LAB\'O',
        'Entreprises externes',
        'Appui au quotidien',
        'Entrainements au pitch',

    ];

    public function load(ObjectManager $manager)
    {
        $count = 0;
        for ($a = 0; $a < 3; $a++) {
            for ($i = 0; $i < 6; $i++) {
                $subservice = new Subservice();
                $subservice->setName(self::CONST_SUBSERVICE[$i]);
                $manager->persist($subservice);
                $subservice->setService($this->getReference('service_' . $a));
                $this->addReference('subservice_' . $count, $subservice);
                $count++;
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ServiceFixtures::class];
    }
}
