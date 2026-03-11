<?php

namespace craft\contentmigrations;

use craft\db\Migration;
use craft\db\Query;

/**
 * Replace "The soul's journey..." quote with "Do good for everyone." — A wise man
 */
class m260310_260000_replace_soul_journey_quote extends Migration
{
    public function safeUp(): bool
    {
        $oldQuote = "The soul's journey is not where it goes after. It's where it goes during.";
        $newQuote = 'Do good for everyone.';
        $newAttribution = 'A wise man';

        $rows = (new Query())
            ->select(['id', 'content'])
            ->from('{{%elements_sites}}')
            ->where(['like', 'content', "soul\\'s journey"])
            ->all();

        $updated = 0;
        foreach ($rows as $row) {
            $content = json_decode($row['content'], true);
            if (!$content) {
                continue;
            }

            $quoteFieldUid = '6e9b0c53-6142-4c6e-8e87-91bef9effd5e';
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

        echo "Replaced soul's journey quote in {$updated} row(s).\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_260000_replace_soul_journey_quote cannot be reverted.\n";
        return false;
    }
}
