<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/12/18
 * Time: 09:41
 */

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
class ParticipantFixtures extends Fixture
{
    const ENTREPRISENAME = [
        'ALTER_EGO',
        'Janasense',
        'NEKOE',
        'Projet IO',
    ];
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $firstName = $faker->firstName();
            $lastName = $faker->name();
            $phoneNumber = $faker->serviceNumber();
            $function = $faker->text(15);
            $quality = $faker->boolean(50);
            $email = strtolower($firstName . '.' . $lastName . '@' .$faker->safeEmailDomain());
            $email = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $email);
            $participant = new Participant();
            $participant->setEmail($email);
            $participant->setFirstName($firstName);
            $participant->setName($lastName);
            $participant->setPhoneNumber($phoneNumber);
            $participant->setFunction($function);
            $participant->setQuality($quality);
            $manager->persist($participant);
        }
        $manager->flush();
    }
}