<?php
declare(strict_types=1);

namespace Immoscout;

/**
 * Class RealEstate
 *
 * @author Jakob Bruening <kontakt@jakobbruening.com>
 * @package Immoscout
 */
class RealEstate extends ApiRequest
{
    public const CHANNEL_IS24    = 'IS24';
    public const CHANNEL_WEBSITE = 'WEBSITE';

    private ?string $publishChannel     = null;

    private bool    $includeAttachments = false;

    private bool    $includeArchive     = false;

    private int     $pageSize           = 100;

    /**
     * Gets all real states from a user
     */
    public function getAll(?int $page = null): array
    {
        $response = $this->handleRequest($page);
        $realEstates = $response['realestates.realEstates']['realEstateList']['realEstateElement'] ?? [];

        if ($page !== null) {
            // Get all real estates by specific page
            return $realEstates;
        }

        $pageCount = (int)$response['realestates.realEstates']['Paging']['numberOfPages'];
        if ($pageCount !== 1) {
            for ($pageIndex = 1; $pageIndex <= $pageCount; $pageIndex++) {
                $pageProperties = $this->handleRequest($pageIndex)['realestates.realEstates']['realEstateList']['realEstateElement'];
                foreach ($pageProperties as $realEstate) {
                    $realEstates[] = $realEstate;
                }
            }
        }

        return $realEstates;
    }

    /**
     * Gets real estate list with details for every property
     */
    public function getAllWithDetails(): array
    {
        $list = $this->getAll();
        foreach ($list as $key => $estate) {
            $list[$key] = array_merge($estate, $this->getOneById((int)$estate['@id']));
        }

        return $list;
    }

    /**
     * Gets one real state by id
     */
    public function getOneById(int $id): array
    {
        $realEstate = $this->request(sprintf('user/me/realestate/%s', $id));

        return $realEstate[array_key_first($realEstate)];
    }

    private function handleRequest(?int $page = null): array
    {
        $url = sprintf(
            'user/me/realestate?archivedobjectsincluded=%s&pagesize=%s&pagenumber=%s',
            $this->includeArchive ? 'true' : 'false',
            $this->pageSize,
            $page ?? 1
        );

        if ($this->publishChannel !== null) {
            $url .= sprintf('&publishchannel=%s', $this->publishChannel);
        }

        if ($this->includeAttachments) {
            $url .= '&features=withAttachments';
        }

        return $this->request($url);
    }

    public function setPublishChannel(?string $publishChannel): self
    {
        $this->publishChannel = $publishChannel;

        return $this;
    }

    public function setIncludeAttachments(bool $includeAttachments): self
    {
        $this->includeAttachments = $includeAttachments;

        return $this;
    }

    public function setIncludeArchive(bool $includeArchive): self
    {
        $this->includeArchive = $includeArchive;

        return $this;
    }

    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }
}