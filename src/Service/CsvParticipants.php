<?php
/**
 * Created by PhpStorm.
 * User: amelie
 * Date: 20/12/18
 * Time: 10:19
 */

namespace App\Service;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;

class CsvParticipants extends Csv
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * CsvFormatEvent constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @return bool
     */
    protected function __validate(): bool
    {
        $nbLineInCsv = count($this->getDataset());
        $headerCsv = $this->getDataset()[0];
        $this->setCsvHeaderFormat(['Name', 'Firstname', 'EntrepriseName', 'Email', 'PhoneNumber', 'Quality']);

        return true;
    }
    /**
     * Import CSV in database
     */
    protected function __import(): void
    {
        $this->addParticipant();
        $this->getEm()->flush();

    }
    /**
     * @param Participant $participant
     * @return Participant
     */
    private function addParticipant() : Participant
    {
        for ($i = 1; $i < count($this->getDataset()); $i++) {

                $participantAdd = new Participant();
                $participantAdd->setName($this->getDataset()[$i][0]);
                $participantAdd->setFirstname($this->getDataset()[$i][0]);
                $participantAdd->setEntrepriseName($this->getDataset()[$i][0]);
                $participantAdd->setEmail($this->getDataset()[$i][0]);
                $participantAdd->setPhoneNumber($this->getDataset()[$i][0]);
                $participantAdd->setQuality($this->getDataset()[$i][0]);
                $this->getEm()->persist($participantAdd);
        }
        return $participantAdd;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEm(): EntityManagerInterface
    {
        return $this->em;
    }
    /**
     * @param EntityManagerInterface $em
     * @return CsvParticipants
     */
    public function setEm(EntityManagerInterface $em): CsvParticipants
    {
        $this->em = $em;
        return $this;
    }
}