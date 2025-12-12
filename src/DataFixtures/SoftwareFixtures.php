<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\Entity\Software;

class SoftwareFixtures extends Fixture
{
    public function load(ObjectManager $manager):void
    {
        $data = new Software();
        $data->setTitle('ADW Cleaner');
        $data->setType('Nettoyage');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('RogueKiller');
        $data->setType('Nettoyage');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('CCleaner');
        $data->setType('Nettoyage');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('JRT');
        $data->setType('Nettoyage');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('ZHP');
        $data->setType('Nettoyage');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('MSE');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('VLC');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Microsoft Teams');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Chrome');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Open Office');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Avast');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Firefox');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Win Defender');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Super Antispyware');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $data = new Software();
        $data->setTitle('Opera');
        $data->setType('Installation/Mise à jour');
        $manager->persist($data);

        $manager->flush();
    }
}
