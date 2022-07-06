<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use FTP\Connection;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../src/ContactService.php';

/**
 * * @covers invalidInputException
 * @covers \ContactService
 *
 * @internal
 */
final class ContactServiceUnitTest extends TestCase {
    private $contactService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->contactService = new ContactService();
    }

    public function testCreationContactWithoutAnyText() {
        $this->contactService = new ContactService();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom  doit être renseigné');
        $this->expectExceptionMessage('le prenom  doit être renseigné');
        $this->contactService->createContact('', '');
    }

    public function testCreationContactWithoutPrenom() {
        $this->contactService = new ContactService();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le prenom doivent être renseignés');
        $this->contactService->createContact('nom', '');
    }

    public function testCreationContactWithoutNom() {
        $this->contactService = new ContactService();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom doivent être renseignés');
        $this->contactService->createContact('', 'prenom');
    }

    public function testSearchContactWithNumber() {
        $this->contactService = new ContactService();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('search doit être une chaine de caractères');
        $this->contactService->searchContact(0);
    }

    public function testModifyContactWithInvalidId() {
        $this->contactService = new ContactService();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");
        static::assertTrue($this->contactService->updateContact(-10, 'nom', 'prenom'));
    }

    public function testDeleteContactWithTextAsId() {
        $this->contactService = new ContactService();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");
        $this->contactService->deleteContact('test');
    }
}
