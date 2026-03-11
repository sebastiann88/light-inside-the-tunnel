<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Trim "Why am I here? To have fun." from the "Live a good life" quote.
 */
class m260310_190000_trim_live_good_life_quote extends Migration
{
    public function safeUp(): bool
    {
        $oldText = 'Live a good life, try to be a good person, and help others when you can. Why am I here? To have fun.';
        $newText = 'Live a good life, try to be a good person, and help others when you can.';

        $rows = (new Query())
            ->select(['id', 'content'])
            ->from('{{%elements_sites}}')
            ->where(['like', 'content', 'Why am I here? To have fun.'])
            ->all();

        $updated = 0;
        foreach ($rows as $row) {
            $newContent = str_replace($oldText, $newText, $row['content']);
            if ($newContent !== $row['content']) {
                $this->db->createCommand(
                    "UPDATE {{%elements_sites}} SET [[content]] = :content WHERE [[id]] = :id",
                    [':content' => $newContent, ':id' => $row['id']]
                )->execute();
                $updated++;
            }
        }

        echo "Trimmed 'Live a good life' quote in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_190000_trim_live_good_life_quote cannot be reverted.\n";
        return false;
    }
}
