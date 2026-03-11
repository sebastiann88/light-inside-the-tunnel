<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Replace "My worth was never the problem" quote with Lao Tzu quote.
 */
class m260310_180000_replace_worth_quote extends Migration
{
    public function safeUp(): bool
    {
        $oldQuote = 'My worth was never the problem. The world just hadn\'t learned how to see it yet.';
        $newQuote = 'In order to become who we might be we need to let go of who we think we are.';
        $newAttribution = 'Lao Tzu';

        $quoteFieldUid = '6e9b0c53-6142-4c6e-8e87-91bef9effd5e';
        $attrFieldUid = 'dde3c3a0-29cc-4c35-9a94-44b81f1bf6d4';

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

        echo "Replaced worth quote with Lao Tzu in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_180000_replace_worth_quote cannot be reverted.\n";
        return false;
    }
}
