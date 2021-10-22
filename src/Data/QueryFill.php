<?php

namespace App\Data;

use App\Data\SearchData;
use Doctrine\ORM\QueryBuilder;

class QueryFill extends QueryBuilder
{
    private QueryBuilder $qb;

    public function __construct(QueryBuilder $qb)
    {
        $this->qb = $qb;

    }
    /**
     * 
     */
    public function addWhereDatCreat(SearchData $search)
    {
        $qb = $this->qb;
        if (!empty($search->datIns)) {
            $datStr1 = date_format($search->datIns, 'Y-m-d' . ' 00:00:00');
            $datStr2 = date_format($search->datIns, 'Y-m-d' . ' 23:59:59');



            $sigDat = $search->sigDat;
            if ($sigDat == '') {
                $sigDat = '=';
            }
            if ($sigDat == '=') {
                $datStr1 = date_format($search->datIns, 'Y-m-d' . ' 00:00:00');
                $datStr2 = date_format($search->datIns, 'Y-m-d' . ' 23:59:59');
            } elseif ($sigDat == '<') {
                $datStr1 = date_format($search->datIns, '1970-01-01' . ' 00:00:00');
                $datStr2 = date_format($search->datIns, 'Y-m-d' . ' 00:00:00');
            } elseif ($sigDat == '<=') {
                $datStr1 = '1970-01-01' . ' 00:00:00';
                $datStr2 = date_format($search->datIns, 'Y-m-d' . ' 23:59:59');
            } elseif ($sigDat == '>=') {
                $datStr1 = date_format($search->datIns, 'Y-m-d' . ' 00:00:00');
                $datStr2 = '9999-12-31' . ' 23:59:59';
            } elseif ($sigDat == '>') {
                $datStr1 = date_format($search->datIns, 'Y-m-d' . ' 23:59:59');
                $datStr2 = '9999-12-31' . ' 23:59:59';
            }
            $qb = $this->qb
                ->andWhere('a.datIns BETWEEN :debut AND :fin')
                ->setParameter('debut', "{$datStr1}")
                ->setParameter('fin', "{$datStr2}");
        }
        return $qb;
    }
    public function whereCurrentYear(QueryBuilder $qb)
    {
        // $qb->andWhere('a.date BETWEEN :debut AND :fin')
        //     ->setParameter('debut', new \Datetime(date('Y') . '-01-01'))
        //     ->setParameter('fin', new \Datetime(date('Y') . '-12-31'));
        // return $qb;
    }
}
