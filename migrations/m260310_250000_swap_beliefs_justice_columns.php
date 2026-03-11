<?php

namespace craft\contentmigrations;

use craft\db\Migration;

/**
 * Move "The beliefs that reach your hands..." to right column
 * and "A just society requires love to function." to left column.
 */
class m260310_250000_swap_beliefs_justice_columns extends Migration
{
    public function safeUp(): bool
    {
        // "The beliefs that reach your hands..." (id 12) — move to right column
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:55', ':id' => 12]
        )->execute();

        // "A just society requires love to function." (id 32) — move to left column
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:54', ':id' => 32]
        )->execute();

        echo "Swapped beliefs/justice quotes for column placement.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_250000_swap_beliefs_justice_columns cannot be reverted.\n";
        return false;
    }
}
