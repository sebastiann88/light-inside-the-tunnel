<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;

/**
 * Seeds the Chapters channel and links featured quotes on the homepage.
 */
class m260310_100500_seed_chapters_and_relations extends Migration
{
    public function safeUp(): bool
    {
        $this->seedChapters();
        $this->linkFeaturedQuotes();

        return true;
    }

    private function seedChapters(): void
    {
        $sectionsService = Craft::$app->getEntries();
        $section = $sectionsService->getSectionByHandle('chapters');
        if (!$section) {
            echo "Chapters section not found — skipping.\n";
            return;
        }

        $entryTypes = $section->getEntryTypes();
        if (empty($entryTypes)) {
            echo "No entry types for chapters — skipping.\n";
            return;
        }
        $entryType = $entryTypes[0];

        $fieldsService = Craft::$app->getFields();
        $hasPartNumber = (bool) $fieldsService->getFieldByHandle('partNumber');
        $hasPartTitle = (bool) $fieldsService->getFieldByHandle('partTitle');
        $hasChapterNumber = (bool) $fieldsService->getFieldByHandle('chapterNumber');
        $hasChapterSummary = (bool) $fieldsService->getFieldByHandle('chapterSummary');

        $chapters = [
            // Prologues (Part 0)
            ['part' => 0, 'partTitle' => 'Prologues', 'chapter' => 0, 'title' => 'Soup, Then a Coat', 'summary' => 'Philosophy starts where life starts — with the ordinary things that turn out not to be ordinary at all.'],
            ['part' => 0, 'partTitle' => 'Prologues', 'chapter' => 0, 'title' => 'Groceries with an Official Pep Talk', 'summary' => ''],
            ['part' => 0, 'partTitle' => 'Prologues', 'chapter' => 0, 'title' => 'The Sandwich Trilogy', 'summary' => ''],
            // Part One
            ['part' => 1, 'partTitle' => 'The Search for Light', 'chapter' => 1, 'title' => 'The Search for Meaning', 'summary' => 'The question underneath every other question. What are we looking for — and what happens when the usual answers stop working?'],
            ['part' => 1, 'partTitle' => 'The Search for Light', 'chapter' => 2, 'title' => 'The Nature of Value and the Invaluable Self', 'summary' => 'What makes something matter. What makes you matter. And why those two questions are the same question.'],
            // Part Two
            ['part' => 2, 'partTitle' => 'Love as the Way', 'chapter' => 3, 'title' => 'The Spirit of Love', 'summary' => 'Love as something larger than romance. A force you practice, not a feeling you wait for.'],
            ['part' => 2, 'partTitle' => 'Love as the Way', 'chapter' => 4, 'title' => 'The Moral Compass', 'summary' => 'How you know which direction is right when no one\'s giving you a map.'],
            ['part' => 2, 'partTitle' => 'Love as the Way', 'chapter' => 5, 'title' => 'Love in Action', 'summary' => 'Where belief meets behavior. The chapter where Consistencialism starts to move your hands.'],
            // Part Three
            ['part' => 3, 'partTitle' => 'The World We Share', 'chapter' => 6, 'title' => 'Nature\'s Equilibrium', 'summary' => 'What the natural world already knows about balance — and what we keep forgetting.'],
            ['part' => 3, 'partTitle' => 'The World We Share', 'chapter' => 7, 'title' => 'Human Connection and Human Potential', 'summary' => 'What\'s possible between people when pretense drops away.'],
            ['part' => 3, 'partTitle' => 'The World We Share', 'chapter' => 8, 'title' => 'Happiness, Fulfillment, and Joy', 'summary' => 'Three different things. Most people chase only one of them.'],
            // Part Four
            ['part' => 4, 'partTitle' => 'The Inner Life', 'chapter' => 9, 'title' => 'The Inner Dialogue', 'summary' => 'The conversation you\'re always having with yourself — and whether it\'s honest.'],
            ['part' => 4, 'partTitle' => 'The Inner Life', 'chapter' => 10, 'title' => 'The Soul\'s Journey', 'summary' => 'Not where the soul goes after. Where it goes during.'],
            ['part' => 4, 'partTitle' => 'The Inner Life', 'chapter' => 11, 'title' => 'Friendship, Presence, and Authenticity', 'summary' => 'What it means to actually be there. For someone else and for yourself.'],
            // Part Five
            ['part' => 5, 'partTitle' => 'Living the Philosophy', 'chapter' => 12, 'title' => 'Communication, Dialogue, and Understanding', 'summary' => 'How to say what you mean. How to hear what others mean. The space between.'],
            ['part' => 5, 'partTitle' => 'Living the Philosophy', 'chapter' => 13, 'title' => 'Conflict, Strength, and the Courage to Understand', 'summary' => 'Strength isn\'t winning the argument. It\'s staying in the room.'],
            ['part' => 5, 'partTitle' => 'Living the Philosophy', 'chapter' => 14, 'title' => 'Love, Care, and Human Dignity', 'summary' => 'The practical face of everything that came before.'],
            ['part' => 5, 'partTitle' => 'Living the Philosophy', 'chapter' => 15, 'title' => 'Consistencialism — A Philosophy for Living', 'summary' => 'The philosophy, fully named and fully explained. Everything the book has been building toward.'],
            ['part' => 5, 'partTitle' => 'Living the Philosophy', 'chapter' => 16, 'title' => 'The Four Pillars of a Good Life', 'summary' => 'What it rests on. What holds it up.'],
            // Epilogue
            ['part' => 6, 'partTitle' => 'Epilogue', 'chapter' => 0, 'title' => 'A Light Inside the Tunnel', 'summary' => 'Where the title earns its meaning.'],
        ];

        $count = 0;
        foreach ($chapters as $chapterData) {
            // Skip if already exists
            $existing = Entry::find()
                ->section('chapters')
                ->title($chapterData['title'])
                ->one();
            if ($existing) {
                continue;
            }

            $entry = new Entry();
            $entry->sectionId = $section->id;
            $entry->typeId = $entryType->id;
            $entry->title = $chapterData['title'];

            $fieldValues = [];
            if ($hasPartNumber) {
                $fieldValues['partNumber'] = $chapterData['part'];
            }
            if ($hasPartTitle) {
                $fieldValues['partTitle'] = $chapterData['partTitle'];
            }
            if ($hasChapterNumber) {
                $fieldValues['chapterNumber'] = $chapterData['chapter'];
            }
            if ($hasChapterSummary) {
                $fieldValues['chapterSummary'] = $chapterData['summary'];
            }
            $entry->setFieldValues($fieldValues);

            if (!Craft::$app->getElements()->saveElement($entry)) {
                echo "Failed to save chapter '{$chapterData['title']}': " . implode(', ', $entry->getFirstErrors()) . "\n";
            } else {
                $count++;
            }
        }

        echo "Seeded {$count} chapters.\n";
    }

    private function linkFeaturedQuotes(): void
    {
        $bookOverview = Entry::find()->section('bookOverview')->one();
        if (!$bookOverview) {
            echo "Book Overview not found — skipping featured quotes.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('featuredQuotes')) {
            echo "featuredQuotes field not found — skipping.\n";
            return;
        }

        // Select 3 featured quotes
        $featuredQuotes = Entry::find()
            ->section('quotes')
            ->isFeatured(true)
            ->limit(3)
            ->ids();

        if (empty($featuredQuotes)) {
            echo "No featured quotes found — skipping.\n";
            return;
        }

        $bookOverview->setFieldValues([
            'featuredQuotes' => $featuredQuotes,
        ]);

        if (!Craft::$app->getElements()->saveElement($bookOverview)) {
            echo "Failed to link featured quotes: " . implode(', ', $bookOverview->getFirstErrors()) . "\n";
        } else {
            echo "Linked " . count($featuredQuotes) . " featured quotes to homepage.\n";
        }
    }

    public function safeDown(): bool
    {
        echo "m260310_100500_seed_chapters_and_relations cannot be reverted.\n";
        return false;
    }
}
