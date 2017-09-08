<?php

class TerrainLeveling {

    public function getMinimum(array $area) : int {
        $levels = $this->getIndividualLevels($area);

        $min = min($levels);
        $max = max($levels);

        $effortByTargetLevel = [];
        for ($n = $min; $n < $max; $n++) {
            // Allow levels [n, n+1]
            $effort = 0;
            foreach ($levels as $level) {
                $diff = min([
                    abs($level - $n),
                    abs($level - ($n + 1))
                ]);
                
                $effort += $diff;
            }
            $effortByTargetLevel[$n] = $effort;
        }

        return min(array_values($effortByTargetLevel));
    }

    public function getIndividualLevels(array $area): array {
        $levels = [];
        foreach ($area as $element) {
            for ($i = 0; $i < strlen($element); $i++) {
                $levels[] = intval($element[$i]);
            }
        }
        return $levels;
    }
}