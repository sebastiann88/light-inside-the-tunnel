<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;

/**
 * Re-seeds text fields on Book Overview and About the Book that failed
 * in m260310_100200 due to the CTA URL validation error.
 */
class m260310_100400_fix_seed_text extends Migration
{
    public function safeUp(): bool
    {
        $fieldsService = Craft::$app->getFields();

        // Book Overview — re-seed text fields (ctaUrl already fixed)
        $bookOverview = Entry::find()->section('bookOverview')->one();
        if ($bookOverview) {
            $fieldValues = [];
            if ($fieldsService->getFieldByHandle('heroHeadline') && !$bookOverview->heroHeadline) {
                $fieldValues['heroHeadline'] = 'You are what you practice.';
            }
            if ($fieldsService->getFieldByHandle('heroSubheadline') && !$bookOverview->heroSubheadline) {
                $fieldValues['heroSubheadline'] = 'Not what you intend. Not what you declare.';
            }
            if ($fieldsService->getFieldByHandle('bookDescription') && !$bookOverview->bookDescription) {
                $fieldValues['bookDescription'] = '<p>This is a book about what happens when you stop performing your beliefs and start living them. It\'s about the distance between what you say matters and what your hands actually do. And it\'s about what you find when you close that gap — not perfection, but something honest. Something that feels like coming home.</p><p><em>The Light Inside the Tunnel</em> was written for anyone who\'s ever sat in the dark and wondered if there\'s a point to all of this. There is. But it\'s not where you were told to look.</p>';
            }
            if ($fieldsService->getFieldByHandle('ctaText') && !$bookOverview->ctaText) {
                $fieldValues['ctaText'] = 'Discover the book';
            }
            if ($fieldsService->getFieldByHandle('pullQuote') && !$bookOverview->pullQuote) {
                $fieldValues['pullQuote'] = 'Spirit is not above us. It is between us.';
            }
            if ($fieldsService->getFieldByHandle('pullQuoteAttribution') && !$bookOverview->pullQuoteAttribution) {
                $fieldValues['pullQuoteAttribution'] = 'Sebastian Matthew Nadeau';
            }

            if (!empty($fieldValues)) {
                $bookOverview->setFieldValues($fieldValues);
                if (!Craft::$app->getElements()->saveElement($bookOverview)) {
                    echo "Failed to update Book Overview: " . implode(', ', $bookOverview->getFirstErrors()) . "\n";
                } else {
                    echo "Updated Book Overview text fields.\n";
                }
            } else {
                echo "Book Overview text fields already populated.\n";
            }
        }

        // About the Book — seed text fields (ctaUrl already fixed)
        $aboutTheBook = Entry::find()->section('aboutTheBook')->one();
        if ($aboutTheBook) {
            $fieldValues = [];
            if ($fieldsService->getFieldByHandle('synopsis') && !$aboutTheBook->synopsis) {
                $fieldValues['synopsis'] = '<p class="text-lead">Most philosophy books ask you to think differently. This one asks you to <em>live</em> differently — and then notice what changes.</p><p><em>The Light Inside the Tunnel</em> starts with a simple observation: the things you practice are the things you actually believe. Everything else is decoration. Your intentions, your declarations, your carefully worded values — they don\'t count until they reach your hands. Until they show up in what you do on a Tuesday afternoon when no one is watching.</p><p>That\'s not a comfortable idea. But it\'s an honest one. And this book is more interested in honesty than comfort.</p>';
            }
            if ($fieldsService->getFieldByHandle('audienceText') && !$aboutTheBook->audienceText) {
                $fieldValues['audienceText'] = '<p>This book is for you if you\'ve ever sat up at 3 AM wondering whether the life you\'re living is actually yours. If you\'ve felt the distance between who you are and who you\'re pretending to be — and you\'re tired of pretending.</p><p>It\'s for people who are suspicious of easy answers but still want answers. People who\'ve read the self-help books and found them thin. People who sense that philosophy should be something you <em>do</em>, not something you study.</p><p>It\'s not for everyone. It\'s not trying to be. But if something on this page made you pause — even for a second — it might be for you.</p>';
            }
            if ($fieldsService->getFieldByHandle('ctaText') && !$aboutTheBook->ctaText) {
                $fieldValues['ctaText'] = 'Get the book';
            }

            if (!empty($fieldValues)) {
                $aboutTheBook->setFieldValues($fieldValues);
                if (!Craft::$app->getElements()->saveElement($aboutTheBook)) {
                    echo "Failed to update About the Book: " . implode(', ', $aboutTheBook->getFirstErrors()) . "\n";
                } else {
                    echo "Updated About the Book text fields.\n";
                }
            } else {
                echo "About the Book text fields already populated.\n";
            }
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_100400_fix_seed_text cannot be reverted.\n";
        return false;
    }
}
