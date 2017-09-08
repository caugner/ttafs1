<?php

class TerrainLeveling {

    use Counting;

    /**
      * Returns the minimum effort required to put the area into ground leveling.
      *
      * @param string[] Area of squares given as strings.
      * @return int Minimum effort.
      */
    public function getMinimum(array $area) : int {
        $squares_per_level = $this->getNumberOfSquaresPerLevel($area);

        $total_effort_per_target_level = $this->getMinimumPerTargetLevel($squares_per_level);

        $total_efforts = array_values($total_effort_per_target_level);
        $min_total_effort = min($total_efforts);

        return $min_total_effort;
    }

    /**
      * Returns the number of squares by level.
      *
      * @param string[] Area of squares given as strings.
      * @return int[] Associative array: number of squares per level.
      */
    protected function getNumberOfSquaresPerLevel(array $area): array {
        $levels = $this->getSquareLevels($area);
        $squares_per_level = $this->countByValue($levels);
        return $squares_per_level;
    }

    /**
      * Returns a list of levels for the squares in the area.
      *
      * @param string[] Area of squares given as strings.
      * @return int[] List of square levels.
      */
    protected function getSquareLevels(array $area): array {
        $levels = [];
        foreach ($area as $element) {
            for ($i = 0; $i < strlen($element); $i++) {
                $levels[] = intval($element[$i]);
            }
        }
        return $levels;
    }

    /**
      * Returns the minimum effort per target level to level all squares up/down to the target level or the level above the target level.
      *
      * @param int[] $squares_per_level Number of squares per level.
      * @return Associative array: minimum effort per target level.
      */
    protected function getMinimumPerTargetLevel(array $squares_per_level): array {
        $unique_levels = array_keys($squares_per_level);
        $min_level = min($unique_levels);
        $max_level = max($unique_levels);

        $total_effort_per_target_level = [];

        for ($target_level = $min_level; $target_level < $max_level; $target_level++) {
            $total_effort = $this->getMinimumForTargetLevels($squares_per_level, $target_level, $target_level + 1);
            $total_effort_per_target_level[$target_level] = $total_effort;
        }

        return $total_effort_per_target_level;
    }

    /**
      * Returns the minimum effort to level all squares up/down to the nearest of the target levels.
      *
      * @param int[] $squares_per_level Number of squares per level.
      * @param int[] $target_levels Acceptable target levels.
      * @return Minimum effort.
      */
    protected function getMinimumForTargetLevels(array $squares_per_level, int ...$target_levels): int {
        $total_effort = 0;

        foreach ($squares_per_level as $level => $square_count) {
            $efforts_to_reach_target_levels = array_map(function($target_level) use ($level) {
                return abs($target_level - $level);
            }, $target_levels);

            $min_effort_for_level_per_square = min($efforts_to_reach_target_levels);

            $min_effort_for_level = $min_effort_for_level_per_square * $square_count;
            $total_effort += $min_effort_for_level;
        }

        return $total_effort;
    }
}
