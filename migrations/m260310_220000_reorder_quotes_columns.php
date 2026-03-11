<?php

namespace craft\contentmigrations;

use craft\db\Migration;

/**
 * Reorder two quotes so "Keep your thoughts deep" lands in the left column
 * and "Compassion is the ability to see another person" lands in the right column.
 *
 * CSS columns fill left-first, so earlier dateCreated = left, later = right.
 */
class m260310_220000_reorder_quotes_columns extends Migration
{
    public function safeUp(): bool
    {
        // "Keep your thoughts deep" (id 58) — move to left column by giving it an early timestamp
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:53', ':id' => 58]
        )->execute();

        // "Compassion is the ability to see another person" (id 34) — move to right column by giving it a late timestamp
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:56', ':id' => 34]
        )->execute();

        echo "Reordered quotes for column placement.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_220000_reorder_quotes_columns cannot be reverted.\n";
        return false;
    }
}
