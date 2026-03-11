<?php

namespace craft\contentmigrations;

use craft\db\Migration;

/**
 * Move "Worth is inherent..." to left column and "A just society..." to right column.
 */
class m260310_240000_swap_worth_justice_columns extends Migration
{
    public function safeUp(): bool
    {
        // "Worth is inherent..." (id 64) — move to left column (early timestamp)
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:54', ':id' => 64]
        )->execute();

        // "A just society requires love to function." (id 32) — move to right column (late timestamp)
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:55', ':id' => 32]
        )->execute();

        echo "Swapped worth/justice quotes for column placement.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_240000_swap_worth_justice_columns cannot be reverted.\n";
        return false;
    }
}
