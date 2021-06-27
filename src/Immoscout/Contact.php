<?php
declare(strict_types=1);

namespace Immoscout;

/**
 * Class Contact
 *
 * @author Jakob Bruening <kontakt@jakobbruening.com>
 * @package Immoscout
 */
class Contact extends ApiRequest
{
    /**
     * Gets a contact by contact id
     */
    public function getAll(): array
    {
        return $this->request('user/me/contact/');
    }

    /**
     * Gets a contact by contact id
     */
    public function getOneById(int $id, $external = false): array
    {
        return $this->request(sprintf('user/me/contact/%s%s', $external ? 'ext-' : '', $id));
    }

    /**
     * Get all contacts, that are visible on the profile page
     */
    public function getVisibleContacts(): array
    {
        $list = $this->getAll()['common.realtorContactDetailsList']['realtorContactDetails'] ?? [];
        $visibleContacts = [];

        foreach ($list as $contact) {
            if ($contact['showOnProfilePage']) {
                continue;
            }

            $visibleContacts[] = $contact;
        }

        return $visibleContacts;
    }
}