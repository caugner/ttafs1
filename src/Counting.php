<?php

trait Counting {

    protected function countByValue(array $values) {
        $counts = [];
        foreach ($values as $value) {
            if (!isset($counts[$value])) {
                $counts[$value] = 1;
            } else {
                $counts[$value] += 1;
            }
        }
        return $counts;
    }
}