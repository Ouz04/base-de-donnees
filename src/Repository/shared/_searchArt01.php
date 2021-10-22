<?php
if (!empty($search->codArt)) {
            $query = $query
                ->andWhere('t.cod like :codArt')
                ->setParameter('codArt', "%{$search->codArt}%");
        }
        if (!empty($search->lib)) {
            $query = $query
                ->andWhere('t.libCrtFr  like :lib')
                ->setParameter('lib', "%{$search->lib}%");
        }
        if (!empty($search->tctgice)) {
            $query = $query
                ->andWhere('d.dsg = :tctgice')
                ->setParameter('tctgice', "{$search->tctgice}");
        }
        if (!empty($search->tsctgice)) {
            $query = $query
                ->andWhere('e.dsg = :tsctgice')
                ->setParameter('tsctgice', "{$search->tsctgice}");
        }
        if (!empty($search->tmrqice)) {
            $query = $query
                ->andWhere('f.nom = :tmrqice')
                ->setParameter('tmrqice', "{$search->tmrqice}");
        }

        if (!empty($search->tfournisseur)) {
            $query = $query
                ->andWhere('g.rso = :tfournisseur')
                ->setParameter('tfournisseur', "{$search->tfournisseur}");
        }