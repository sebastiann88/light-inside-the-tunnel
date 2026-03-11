<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Replace "Strength isn't winning the argument" quote with "Wisdom is knowing knowledge in practice."
 */
class m260310_210000_replace_strength_quote extends Migration
{
    public function safeUp(): bool
    {
        $oldQuote = "Strength isn't winning the argument. It's staying in the room.";
        $newQuote = 'Wisdom is knowing knowledge in practice.';

        $rows = (new Query())
            ->select(['id', 'content'])
            ->from('{{%elements_sites}}')
            ->where(['like', 'content', "Strength isn"])
            ->all();

        $updated = 0;
        foreach ($rows as $row) {
            $content = json_decode($row['content'], true);
            if (!$content) {
                continue;
            }

            // quoteText field
            $quoteFieldUid = '6e9b0c53-6142-4c6e-8e87-91bef9effd5e';

            if (isset($content[$quoteFieldUid]) && $content[$quoteFieldUid] === $oldQuote) {
                $content[$quoteFieldUid] = $newQuote;

                $encoded = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $this->db->createCommand(
                    "UPDATE {{%elements_sites}} SET [[content]] = :content WHERE [[id]] = :id",
                    [':content' => $encoded, ':id' => $row['id']]
                )->execute();
                $updated++;
            }
        }

        echo "Replaced strength quote in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_210000_replace_strength_quote cannot be reverted.\n";
        return false;
    }
}
