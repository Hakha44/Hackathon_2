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
        'Aquasys',
        'Projet IO',
        'The Bar Corner',
        'Dcid',
        'Dev3l',
        'Ebony',
        'Eclo',
        'EcoGreen',
        'Episanté',
        'Fablab',
        'Géonomie',
        'GKeep',
        'Lyoo',
        'Invite1Chef',
        'Kiwik',
        'Styx',
        'Vox\'M',
    ];
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $firstName = $faker->firstName();
            $lastName = $faker->lastName();
            $phoneNumber = $faker->serviceNumber();
            $function = $faker->text(15);
            $quality = $faker->boolean(50);
            $present = $faker->boolean(50);
            $email = strtolower($firstName . '.' . $lastName . '@' .$faker->safeEmailDomain());
            $email = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $email);
            $participant = new Participant();
            $participant->setEntrepriseName(self::ENTREPRISENAME[rand(0,19)]);
            $participant->setEmail($email);
            $participant->setFirstName($firstName);
            $participant->setName($lastName);
            $participant->setPhoneNumber($phoneNumber);
            $participant->setFunction($function);
            $participant->setQuality($quality);
            $participant->setPresent($present);
            $manager->persist($participant);
        }
        $manager->flush();
    }
}
