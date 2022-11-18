<?php

namespace App\DataFixtures;

use App\Entity\Element;
use App\Entity\Yoga;
use App\Entity\Data;
use App\Entity\Rate;
use App\Entity\Schedulde;
use App\Entity\RateType;
use App\Entity\ScheduldeType;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data1 = new Data();
        $data1->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean porttitor eros vitae bibendum maximus. Etiam eleifend rutrum purus eget fermentum. Aliquam dictum nisl magna, in vehicula tortor tincidunt lobortis. Nullam hendrerit nisi at facilisis placerat. Nulla dignissim libero pharetra, bibendum sapien at, ullamcorper ante. Vestibulum convallis aliquam sapien sed placerat. Morbi tristique, leo ornare viverra imperdiet, urna augue tincidunt augue, nec blandit diam massa at elit. Phasellus sed ante vulputate quam tincidunt ornare. Vestibulum luctus nisl eget placerat auctor. Integer ut nisl ac mi tristique sodales. Suspendisse sit amet odio pretium, posuere leo id, porttitor nulla. Nulla dapibus porttitor malesuada.');
        $data1->setSize('wide');
        $manager->persist($data1);

        $data2 = new Data();
        $data2->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean porttitor eros vitae bibendum maximus. Etiam eleifend rutrum purus eget fermentum. Aliquam dictum nisl magna, in vehicula tortor tincidunt lobortis. Nullam hendrerit nisi at facilisis placerat. Nulla dignissim libero pharetra, bibendum sapien at, ullamcorper ante. Vestibulum convallis aliquam sapien sed placerat. Morbi tristique, leo ornare viverra imperdiet, urna augue tincidunt augue, nec blandit diam massa at elit. Phasellus sed ante vulputate quam tincidunt ornare. Vestibulum luctus nisl eget placerat auctor. Integer ut nisl ac mi tristique sodales. Suspendisse sit amet odio pretium, posuere leo id, porttitor nulla. Nulla dapibus porttitor malesuada.');
        $data2->setSize('wide');
        $manager->persist($data2);

        $rateType = new RateType();
        $rateType->setEvent('Name of event');
        $rateType->setPrice('30');
        $manager->persist($rateType);

        $rate = new Rate();
        $rate->addType($rateType);
        $manager->persist($rate);

        $schedulde1 = new ScheduldeType();
        $schedulde1->setDay('Lundi');
        $schedulde1->setStartTime(new \DateTime("2015-11-01 09:06:12"));
        $schedulde1->setEndTime(new \DateTime("2015-11-01 09:26:12"));
        $schedulde1->setPlace('Saintes');
        $manager->persist($schedulde1);

        $schedulde2 = new ScheduldeType();
        $schedulde2->setDay('Mercredi');
        $schedulde2->setStartTime(new \DateTime("2015-11-01 11:06:12"));
        $schedulde2->setEndTime(new \DateTime("2015-11-01 11:26:12"));
        $schedulde2->setPlace('Fontcouverte');
        $manager->persist($schedulde2);

        $schedulde = new Schedulde();
        $schedulde->addType($schedulde1);
        $schedulde->addType($schedulde2);
        $manager->persist($schedulde);

        $element1 = new Element();
        $element1->setData($data1);
        $element1->setRank(1);
        $element2 = new Element();        
        $element2->setData($data2);
        $element2->setRank(3);
        $element3 = new Element();  
        $element3->setSchedulde($schedulde);
        $element3->setRank(2);
        $element4 = new Element();  
        $element4->setRate($rate);
        $element4->setRank(4);
        $manager->persist($element1);
        $manager->persist($element2);
        $manager->persist($element3);
        $manager->persist($element4);

        $yoga = new Yoga();
        $yoga->addElement($element1);
        $yoga->addElement($element2);
        $yoga->addElement($element3);
        $yoga->addElement($element4);
        $manager->persist($yoga);

        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle('Article '.$i);
            $article->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus volutpat velit at vulputate. Fusce viverra dolor eget est condimentum molestie. Ut lorem massa, finibus nec elementum sed, tincidunt id lectus. Integer tristique, justo eu vehicula tincidunt, erat urna vehicula eros, nec egestas velit libero nec risus. Duis at odio a ligula porta luctus. Nam in viverra tellus. Vestibulum quis maximus orci.

                Curabitur luctus ex et tellus maximus tincidunt. Vivamus vitae sodales erat. Fusce luctus, tellus at accumsan tempus, quam lacus hendrerit ante, et iaculis urna arcu id mi. Cras et ornare lacus, ut pharetra sem. Quisque semper, justo at lobortis elementum, libero purus fringilla tellus, at efficitur augue enim a ante. Ut volutpat nibh non felis bibendum, ut efficitur nunc sodales. Duis sit amet libero sed quam aliquam elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus.

                Proin porta facilisis est pellentesque elementum. Duis tincidunt sem vel libero mollis tincidunt. Vivamus quis ullamcorper neque. Pellentesque dictum dignissim diam, a dapibus sem porttitor a. Donec in dui ut nunc vehicula dapibus porttitor sit amet turpis. Vestibulum pretium nulla nibh, id sollicitudin purus elementum eu. Aenean dapibus lobortis tortor in tristique. Aenean massa augue, vestibulum sit amet lacus lobortis, porttitor egestas diam. Suspendisse ut urna orci.');
            $article->setDate(new \DateTime("2015-11-".mt_rand(1, 30)." 09:06:12"));
            $article->setCategory('yoga');
            $manager->persist($article);
        }


        $manager->flush();
    }
}
