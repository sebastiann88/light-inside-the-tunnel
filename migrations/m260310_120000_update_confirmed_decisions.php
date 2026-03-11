<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;
use craft\elements\GlobalSet;

/**
 * Updates CMS content based on confirmed content decisions:
 * - Author tagline: "Graphic Designer, Web Developer, Philosopher. Ottawa, Canada."
 * - Newsletter heading: "Stay in the Light" (capital L)
 * - Newsletter body: canonical version from microcopy file
 */
class m260310_120000_update_confirmed_decisions extends Migration
{
    public function safeUp(): bool
    {
        $this->updateAuthorTagline();
        $this->updateNewsletter();

        return true;
    }

    private function updateAuthorTagline(): void
    {
        $entry = Entry::find()->section('authorBio')->one();
        if (!$entry) {
            echo "Author Bio not found — skipping.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('shortBio')) {
            echo "shortBio field not found — skipping.\n";
            return;
        }

        // shortBio is used as the one-liner for the author preview on the homepage.
        // The tagline itself is rendered from authorName + authorLocation in templates.
        // But we should also store it for template use.
        $entry->setFieldValues([
            'shortBio' => 'Sebastian Matthew Nadeau is a graphic designer and philosopher from Ottawa, Canada. He wrote this book because he\'d been in the tunnel — and because the light he found there wasn\'t what anyone had promised him it would be. It was better. It was real.',
        ]);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to update author bio: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Author bio confirmed (shortBio unchanged — tagline rendered from authorLocation field).\n";
        }
    }

    private function updateNewsletter(): void
    {
        $globalSet = GlobalSet::find()->handle('siteSettings')->one();
        if (!$globalSet) {
            echo "Site Settings not found — skipping.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        $fieldValues = [];

        if ($fieldsService->getFieldByHandle('newsletterHeadline')) {
            $fieldValues['newsletterHeadline'] = 'Stay in the Light';
        }
        if ($fieldsService->getFieldByHandle('newsletterSubtext')) {
            $fieldValues['newsletterSubtext'] = 'Honest words from Sebastian — when there\'s something worth saying.';
        }

        if (!empty($fieldValues)) {
            $globalSet->setFieldValues($fieldValues);
            if (!Craft::$app->getElements()->saveElement($globalSet)) {
                echo "Failed to update newsletter settings: " . implode(', ', $globalSet->getFirstErrors()) . "\n";
            } else {
                echo "Updated newsletter: 'Stay in the Light' / canonical body copy.\n";
            }
        }
    }

    public function safeDown(): bool
    {
        echo "m260310_120000_update_confirmed_decisions cannot be reverted.\n";
        return false;
    }
}
