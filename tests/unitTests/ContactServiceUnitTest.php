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
    }

    public function testCreationContactWithoutPrenom() {
    }

    public function testCreationContactWithoutNom() {
    }

    public function testSearchContactWithNumber() {
    }

    public function testModifyContactWithInvalidId() {
    }

    public function testDeleteContactWithTextAsId() {
    }
}
