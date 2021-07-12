<?php
declare(strict_types=1);

namespace Immoscout;

use http\Exception\InvalidArgumentException;

class OnTopPlacement extends ApiRequest
{
    public const  SHOW_CASE       = 'showcaseplacement';
    public const  PREMIUM         = 'premiumplacement';
    public const  TOP             = 'topplacement';
    private const PLACEMENT_TYPES = [self::SHOW_CASE, self::PREMIUM, self::TOP];

    private string $placement = self::SHOW_CASE;

    /**
     * Gets all ontop placed real estates
     */
    public function getAll(): array
    {
        return $this->request(sprintf('%s/all', $this->placement));
    }

    /**
     * Get one ontop placed real estate by id
     */
    public function getOneById(int $id): array
    {
        return $this->request(sprintf('realestate/%s/%s', $id, $this->placement));
    }

    public function setPlacement(string $placement): self
    {
        if (!in_array($placement, self::PLACEMENT_TYPES, true)) {
            throw new InvalidArgumentException(sprintf('Placement %s is invalid.', $placement));
        }

        $this->placement = $placement;

        return $this;
    }

    public function getPlacement(): string
    {
        return $this->placement;
    }
}