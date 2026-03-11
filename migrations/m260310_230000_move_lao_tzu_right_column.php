<?php

namespace craft\contentmigrations;

use craft\db\Migration;

/**
 * Move "In order to become who we might be" quote to the right column
 * by giving it a later dateCreated timestamp.
 */
class m260310_230000_move_lao_tzu_right_column extends Migration
{
    public function safeUp(): bool
    {
        // "In order to become who we might be..." (id 20) — move to right column
        $this->db->createCommand(
            "UPDATE {{%elements}} SET [[dateCreated]] = :ts WHERE [[id]] = :id",
            [':ts' => '2026-03-10 10:01:55', ':id' => 20]
        )->execute();

        echo "Moved Lao Tzu quote to right column.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_230000_move_lao_tzu_right_column cannot be reverted.\n";
        return false;
    }
}
