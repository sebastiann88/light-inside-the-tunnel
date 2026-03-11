<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;

/**
 * Seeds the Quotes channel with the 30 curated quotes.
 */
class m260310_100100_seed_quotes extends Migration
{
    public function safeUp(): bool
    {
        $sectionsService = Craft::$app->getEntries();
        $section = $sectionsService->getSectionByHandle('quotes');
        if (!$section) {
            echo "Quotes section not found — skipping seed.\n";
            return true;
        }

        $entryTypes = $section->getEntryTypes();
        if (empty($entryTypes)) {
            echo "No entry types for quotes section — skipping.\n";
            return true;
        }
        $entryType = $entryTypes[0];

        $quotes = [
            ['text' => 'You are what you practice. Not what you intend. Not what you declare.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => true],
            ['text' => 'The beliefs that reach your hands are the only beliefs that matter.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Wisdom is knowing knowledge in practice.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => "It's not about preaching what you believe, it's about leading by example.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Quiet deeds speak the loudest words.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => "My worth was never the problem. The world just hadn't learned how to see it yet.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Everyone is invisible, until one day they become famous.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => "Real gems are not found in stones, they are found in people's hearts.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'I believe in the soul of humanity. Love comes from the soul.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Spirit is not above us. It is between us.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => true],
            ['text' => "You don't fix people; you heal them.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'A just society requires love to function.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Compassion is the ability to see another person as an extension of yourself, so when they are wounded, you cry.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'A gardener does not tell a flower how to grow. A gardener protects the soil.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Justice is the preservation of harmony between people, threatened not by evil but by indifference.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'We use different lyrics for the same instrumental.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'The beauty of the soldier is found in the battle you fight inside.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => "Strength isn't winning the argument. It's staying in the room.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Gifts do not replace the human presence.', 'attribution' => 'Rodrigue Nitounga', 'featured' => false],
            ['text' => "The soul's journey is not where it goes after. It's where it goes during.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Psychological safety comes before physical safety.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'The world becomes lighter, when your thoughts are not so heavy.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Live a good life, try to be a good person, and help others when you can. Why am I here? To have fun.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => true],
            ['text' => 'The smallest light can bright up your spirit.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Keep your thoughts deep, and your mood light.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Seek to understand where the person shines, not where their shadow lies.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'These pages are less about me, and more about the hope that others may find a light for themselves within them.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Worth is inherent and untouchable, but dignity lives between people and depends on whether we choose to see each other.', 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => "Life is self-evident. People's perceptions are not.", 'attribution' => 'Sebastian Matthew Nadeau', 'featured' => false],
            ['text' => 'Be the change that you wish to see in the world.', 'attribution' => 'Mahatma Gandhi', 'featured' => false],
        ];

        $fieldsService = Craft::$app->getFields();
        $hasQuoteText = (bool) $fieldsService->getFieldByHandle('quoteText');
        $hasAttribution = (bool) $fieldsService->getFieldByHandle('attribution');
        $hasIsFeatured = (bool) $fieldsService->getFieldByHandle('isFeatured');

        $count = 0;
        foreach ($quotes as $quoteData) {
            // Check if quote already exists
            $existing = Entry::find()
                ->section('quotes')
                ->title(substr($quoteData['text'], 0, 50))
                ->one();
            if ($existing) {
                continue;
            }

            $entry = new Entry();
            $entry->sectionId = $section->id;
            $entry->typeId = $entryType->id;
            $entry->title = mb_substr($quoteData['text'], 0, 80) . (mb_strlen($quoteData['text']) > 80 ? '...' : '');

            $fieldValues = [];
            if ($hasQuoteText) {
                $fieldValues['quoteText'] = $quoteData['text'];
            }
            if ($hasAttribution) {
                $fieldValues['attribution'] = $quoteData['attribution'];
            }
            if ($hasIsFeatured) {
                $fieldValues['isFeatured'] = $quoteData['featured'];
            }
            $entry->setFieldValues($fieldValues);

            if (!Craft::$app->getElements()->saveElement($entry)) {
                echo "Failed to save quote: " . implode(', ', $entry->getFirstErrors()) . "\n";
            } else {
                $count++;
            }
        }

        echo "Seeded {$count} quotes.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_100100_seed_quotes cannot be reverted.\n";
        return false;
    }
}
