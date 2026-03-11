<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Replace Gandhi quote with Sebastian's soldier quote.
 */
class m260310_170000_replace_gandhi_quote extends Migration
{
    public function safeUp(): bool
    {
        $oldQuote = 'Be the change that you wish to see in the world.';
        $newQuote = 'It is not the uniform that makes the soldier; it is the person inside, which forms them.';
        $newAttribution = 'Sebastian Matthew Nadeau';

        $rows = (new Query())
            ->select(['id', 'content'])
            ->from('{{%elements_sites}}')
            ->where(['like', 'content', $oldQuote])
            ->all();

        $updated = 0;
        foreach ($rows as $row) {
            $content = json_decode($row['content'], true);
            if (!$content) {
                continue;
            }

            // quoteText field
            $quoteFieldUid = '6e9b0c53-6142-4c6e-8e87-91bef9effd5e';
            // attribution field
            $attrFieldUid = 'dde3c3a0-29cc-4c35-9a94-44b81f1bf6d4';

            if (isset($content[$quoteFieldUid]) && $content[$quoteFieldUid] === $oldQuote) {
                $content[$quoteFieldUid] = $newQuote;
                $content[$attrFieldUid] = $newAttribution;

                $encoded = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $this->db->createCommand(
                    "UPDATE {{%elements_sites}} SET [[content]] = :content WHERE [[id]] = :id",
                    [':content' => $encoded, ':id' => $row['id']]
                )->execute();
                $updated++;
            }
        }

        echo "Replaced Gandhi quote in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_170000_replace_gandhi_quote cannot be reverted.\n";
        return false;
    }
}
