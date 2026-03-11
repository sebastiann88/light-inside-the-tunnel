<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Update belief #2 text in the consistencialismSection field.
 *
 * Old: "2. I believe life is the pursuit of something we cannot fully reach alone."
 * New: "2. I believe we are imperfect, therefore life is the pursuit of something we cannot fully reach alone."
 */
class m260310_160000_update_belief_two extends Migration
{
    public function safeUp(): bool
    {
        $fieldUid = 'd47e0034-c0b1-4b42-b1aa-f4c3ef5b3adf';

        $oldText = '<strong>2. I believe life is the pursuit of something we cannot fully reach alone.</strong>';
        $newText = '<strong>2. I believe we are imperfect, therefore life is the pursuit of something we cannot fully reach alone.</strong>';

        // Find all elements_sites rows that contain this field with the old text
        $rows = (new Query())
            ->select(['id', 'content'])
            ->from('{{%elements_sites}}')
            ->where(['like', 'content', $oldText])
            ->all();

        $updated = 0;
        foreach ($rows as $row) {
            $newContent = str_replace($oldText, $newText, $row['content']);
            if ($newContent !== $row['content']) {
                $this->update('{{%elements_sites}}', ['content' => $newContent], ['id' => $row['id']]);
                $updated++;
            }
        }

        echo "Updated belief #2 in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_160000_update_belief_two cannot be reverted.\n";
        return false;
    }
}
