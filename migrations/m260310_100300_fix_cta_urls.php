<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;

/**
 * Fixes CTA URL fields on Book Overview and About the Book singles.
 * Link fields in Craft 5 require structured array values.
 */
class m260310_100300_fix_cta_urls extends Migration
{
    public function safeUp(): bool
    {
        // Book Overview — CTA links to /the-book (aboutTheBook single)
        $bookOverview = Entry::find()->section('bookOverview')->one();
        $aboutTheBook = Entry::find()->section('aboutTheBook')->one();

        if ($bookOverview && $aboutTheBook) {
            $bookOverview->setFieldValues([
                'ctaUrl' => [
                    'type' => 'entry',
                    'value' => $aboutTheBook->id,
                ],
            ]);
            if (!Craft::$app->getElements()->saveElement($bookOverview)) {
                echo "Failed to update Book Overview CTA: " . implode(', ', $bookOverview->getFirstErrors()) . "\n";
            } else {
                echo "Updated Book Overview CTA URL → About the Book entry.\n";
            }
        }

        // About the Book — CTA links to /get-the-book (URL type since no section)
        if ($aboutTheBook) {
            $aboutTheBook->setFieldValues([
                'ctaUrl' => [
                    'type' => 'url',
                    'value' => 'https://light-inside-the-tunnel.ddev.site/get-the-book',
                ],
            ]);
            if (!Craft::$app->getElements()->saveElement($aboutTheBook)) {
                echo "Failed to update About the Book CTA: " . implode(', ', $aboutTheBook->getFirstErrors()) . "\n";
            } else {
                echo "Updated About the Book CTA URL → /get-the-book.\n";
            }
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_100300_fix_cta_urls cannot be reverted.\n";
        return false;
    }
}
