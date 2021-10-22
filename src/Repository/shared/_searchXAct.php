<?php

if ($search->xAct >= '0') {

    $query = $query
        ->andWhere('a.xAct = :xAct')
        ->setParameter('xAct', "{$search->xAct}");
}
