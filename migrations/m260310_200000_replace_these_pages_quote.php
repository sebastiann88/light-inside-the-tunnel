<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Replace "These pages are less about me…" quote with authenticity quote.
 */
class m260310_200000_replace_these_pages_quote extends Migration
{
    public function safeUp(): bool
    {
        $oldQuote = 'These pages are less about me, and more about the hope that others may find a light for themselves within them.';
        $newQuote = 'We are free to express ourselves authentically, so long as our way of life does not destroy life itself.';
        $newAttribution = 'Sebastian Matthew Nadeau';

        // quoteText field UID
        $quoteFieldUid = '6e9b0c53-6142-4c6e-8e87-91bef9effd5e';
        // attribution field UID
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

        echo "Replaced 'these pages' quote in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_200000_replace_these_pages_quote cannot be reverted.\n";
        return false;
    }
}
