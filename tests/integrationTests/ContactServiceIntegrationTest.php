<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;

require __DIR__.'/../../src/ContactService.php';

/**
 * * @covers invalidInputException
 * @covers \ContactService
 *
 * @internal
 */
final class ContactServiceIntegrationTest extends TestCase
{
    private $contactService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->contactService = new ContactService();
    }

    public function Initiatialize()
    {
        // $this->createDB();
        $this->contactService = new ContactService();
        $this->contactService->init('contactsTest.sqlite');
    }

    public function testInitiatialize()
    {
        $this->contactService = new ContactService();
        static::assertTrue($this->contactService->init('contactsTest.sqlite'));
        
    }


    // test de suppression de toute les données, nécessaire pour nettoyer la bdd de tests à la fin
    public function testDeleteAll()
    {
        $this->Initiatialize('contactsTest.sqlite');
        static::assertTrue($this->contactService->createContact('testNom', 'testPrenom'));
        static::assertTrue($this->contactService->createContact('testNom2', 'testPrenom2'));

        $this->contactService->deleteAllContact();
        // on vérifie que la suppression de tous les contacts a fonctionnée
        // faire sans utiliser fct classe contact ?
        static::assertSame(0, count($this->contactService->getAllContacts()));
        
    }


    public function testCreationContact()
    {
        $this->Initiatialize('contactsTest.sqlite');
        static::assertTrue($this->contactService->createContact('testNom', 'testPrenom'));
        $data = $this->contactService->getAllContacts();
        
        static::assertSame('testNom', $data[0]['nom']);
        static::assertSame('testPrenom', $data[0]['prenom']);
        $this->id = $data[0]['id'];
    }

    public function testSearchContact()
    {
        $this->Initiatialize('contactsTest.sqlite');
        $this->testCreationContact();
        static::assertSame(1, count($this->contactService->searchContact('testNom')));
    }

    public function testModifyContact()
    {
        $this->Init('contactsTest.sqlite');
        $this->testCreationContact();
        static::assertTrue($this->contactService->updateContact($this->id, 'testUpNom', 'testUpNom'));
        $data = $this->contactService->getContact($this->id);
        // echo "modify contact : ";
        // echo var_dump($data);
        static::assertSame('testUpNom', $data['nom']);
        static::assertSame('testUpNom', $data['prenom']);
    }

    public function testDeleteContact()
    {
        $this->Initiatialize('contactsTest.sqlite');
        $this->contactService->deleteContact(0);
        static::assertSame(0, count($this->contactService->getAllContacts()));
    }

}
