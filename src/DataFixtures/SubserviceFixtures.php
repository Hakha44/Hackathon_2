<?php

namespace App\DataFixtures;

use App\Entity\Subservice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubserviceFixtures extends Fixture
{
    const CONST_SUBSERVICE =[
        'Atelier',
        'Permanences Experts',
        'Partenaires du LAB\'O',
        'Entreprises externes',
        'Appui au quotidien',
        'Entrainements au pitch',

    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 6; $i++) {
            $service = new Subservice();
            $service->setName(self::CONST_SUBSERVICE[$i]);
            $manager->persist($service);

        }
        $manager->flush();
    }
}
