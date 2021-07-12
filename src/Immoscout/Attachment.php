<?php
declare(strict_types=1);

namespace Immoscout;

/**
 * Class Attachment
 *
 * @author Jakob Bruening <kontakt@jakobbruening.com>
 * @package Immoscout
 */
class Attachment extends ApiRequest
{
    /**
     * Gets array of attachments by real state id
     */
    public function getAllByRealEstate(int $id)
    {
        $url = sprintf('realestate/%s/attachment', $id,);

        return $this->request($url)['common.attachments'] ?? [];
    }

    /**
     * Gets one attachment by attachment id and real state id
     */
    public function getOneById(int $realEstateId, int $id)
    {
        return $this->request(sprintf('realestate/%s/attachment/%s', $realEstateId, $id));
    }
}