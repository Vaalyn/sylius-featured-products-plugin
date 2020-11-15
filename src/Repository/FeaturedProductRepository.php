<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Model\ChannelInterface;

class FeaturedProductRepository extends EntityRepository
{
    /**
     * @return Channel[]
     */
    public function fetchForChannel(
        ChannelInterface $channel,
        int $limit
    ): array {
        $queryBuilder = $this->createQueryBuilder('fp')
            ->leftJoin('fp.channels', 'fpc')
            ->leftJoin('fp.product', 'p')
            ->where('fpc.id = :channelId');

        $randomIds = $this->fetchRandomIds($channel, $limit);

        $queryBuilder->andWhere(
            $queryBuilder->expr()->in('fp.id', $randomIds)
        );

        return $queryBuilder
            ->setMaxResults($limit)
            ->setParameter('channelId', $channel->getId())
            ->getQuery()
            ->getResult();
    }

    /**
     * @return int[]
     */
    protected function fetchRandomIds(ChannelInterface $channel, int $limit): array
    {
        $availableFeaturedProductIds = $this->createQueryBuilder('fp')
            ->select('fp.id')
            ->leftJoin('fp.channels', 'fpc')
            ->where('fpc.id = :channelId')
            ->setParameter('channelId', $channel->getId())
            ->getQuery()
            ->getArrayResult();

        $availableFeaturedProductIds = array_column($availableFeaturedProductIds, 'id');

        $resultCount = count($availableFeaturedProductIds);

        $limit = min($limit, $resultCount);

        $keysOfRandomlyPickedResults = (array) array_rand($availableFeaturedProductIds, $limit);

        return array_map(function($key) use ($availableFeaturedProductIds) {
            return $availableFeaturedProductIds[$key];
        }, $keysOfRandomlyPickedResults);
    }
}
