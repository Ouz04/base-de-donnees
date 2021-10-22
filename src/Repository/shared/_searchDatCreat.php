<?php

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
    $query = $query
        ->andWhere('a.datIns BETWEEN :debut AND :fin')
        ->setParameter('debut', "{$datStr1}")
        ->setParameter('fin', "{$datStr2}");
}
if (!empty($search->usrInsEmail)) {
    // dd($search->usrInsEmail);
    $query = $query
        ->andWhere('h.email= :usr')
        ->setParameter('usr', "{$search->usrInsEmail}");
}
if (!empty($search->srvDsg)) {
    $query = $query
        ->andWhere('i.dsg= :srvDsg')
        ->setParameter('srvDsg', "{$search->srvDsg}");
}
