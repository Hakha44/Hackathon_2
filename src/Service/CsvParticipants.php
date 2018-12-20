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
     * @var integer
     */
    private $numberOfPlayers;
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
        // Check Header Csv
//        if (!$this->checkHeaderCsv($headerCsv)) {
//            throw new CsvException('L\'en-tête de votre fichier doit être : Table, Player, Round 1, Round 2, etc.');
////        }
//        $nbRound = count($headerCsv) - 2;
//        $this->setNumberOfPlayers(($nbRound - 1) ** 2);
//        if ($this->getNumberOfPlayers() !== ($nbLineInCsv - 1)) {
//            throw new CsvException('Votre matrice n\'est pas valide.');
//        }
//        // Check Number of table
//        if (!$this->checkNumberOfTable($this->getDataset(), $nbRound - 1)) {
//            throw new CsvException('Le nombre de table n\'est pas valide.');
//        }
//        // Check speaker's cell is integer
//        if (!$this->checkSpeakerCellIsInteger($this->getDataset())) {
//            throw new CsvException('Les participants doivent être identifiés par des entiers.');
//        }
//        // Check if the numbers of speakers are a sequence of numbers, between [1-nbSpeackers]
//        if (!$this->checkNumbersSpeakersIsASequence($this->getDataset(), $this->getNumberOfPlayers())) {
//            throw new CsvException('Votre matrice ne contient pas une suite logique d\'entiers pour l\'un des rounds.');
//        }
        return true;
    }
    /**
     * Import CSV in database
     */
    protected function __import(): void
    {
        $this->getEm()->getConnection()->beginTransaction();
////        try {
            $participant = new Participant();
            $participant = $this->setName('Name');
            $participant = $this->setFirstname();
            $this->getEm()->persist($participant);
            $this->getEm()->flush();
            $this->getEm()->getConnection()->commit();
//        } catch (\Exception $e) {
//            $this->getEm()->getConnection()->rollBack();
//        }
    }
    /**
     * @param Participant $participant
     * @return Participant
     */
    private function addParticipant(Participant $participant) : Participant
    {
        for ($i = 1; $i < count($this->getDataset()); $i++) {
//            $round = 1;
//            $tableEvent = $this->getTableEvent($this->getDataset()[$i][0]);
//            for ($j = 2; $j < count($this->getDataset()[$i]); $j++) {
                $participantAdd = new Participant();
                $participantAdd->setName();
                $participantAdd->setFirstname();
                $participantAdd->setEntrepriseName();
                $participantAdd->setEmail();
                $participantAdd->setPhoneNumber();
                $participantAdd->setQuality();
//                $participant->addParticipant($participantAdd);

//            }
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