<?php

namespace App\DataFixtures;

use App\Entity\Subservice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SubserviceFixtures extends Fixture implements DependentFixtureInterface
{
    const CONST_SUBSERVICE_1 = [
        'Ateliers',
        'Permanences experts',
    ];

    const CONST_SUBSERVICE_2 = [
        'Partenaires du LAB\'O',
        'Entreprises externes',
    ];

    const CONST_SUBSERVICE_3 = [
        'Appui au quotidien',
        'Entraînement au pitch',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count(self::CONST_SUBSERVICE_1); $i++) {
            $subservice = new Subservice();
            $subservice->setName(self::CONST_SUBSERVICE_1[$i]);
            $manager->persist($subservice);
            $subservice->setService($this->getReference('service_0'));
            $this->addReference('subservice_' . $i, $subservice);
        }

        for ($y = 0; $y < count(self::CONST_SUBSERVICE_2); $y++) {
            $subservice = new Subservice();
            $subservice->setName(self::CONST_SUBSERVICE_2[$y]);
            $manager->persist($subservice);
            $subservice->setService($this->getReference('service_1'));
            $this->addReference('subservice_' . $i, $subservice);
            $i++;
        }
        for ($y = 0; $y < count(self::CONST_SUBSERVICE_3); $y++) {
            $subservice = new Subservice();
            $subservice->setName(self::CONST_SUBSERVICE_3[$y]);
            $manager->persist($subservice);
            $subservice->setService($this->getReference('service_2'));
            $this->addReference('subservice_' . $i, $subservice);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ServiceFixtures::class];
    }
}
