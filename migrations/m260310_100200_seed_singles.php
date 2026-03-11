<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;

/**
 * Seeds the three single-entry sections with initial content.
 * - Book Overview (homepage)
 * - About the Book (/the-book)
 * - Author Bio (/about-the-author)
 */
class m260310_100200_seed_singles extends Migration
{
    public function safeUp(): bool
    {
        $this->seedBookOverview();
        $this->seedAboutTheBook();
        $this->seedAuthorBio();

        return true;
    }

    private function seedBookOverview(): void
    {
        $entry = Entry::find()->section('bookOverview')->one();
        if (!$entry) {
            echo "Book Overview section not found — skipping.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        $fieldValues = [];

        if ($fieldsService->getFieldByHandle('heroHeadline')) {
            $fieldValues['heroHeadline'] = 'You are what you practice.';
        }
        if ($fieldsService->getFieldByHandle('heroSubheadline')) {
            $fieldValues['heroSubheadline'] = 'Not what you intend. Not what you declare.';
        }
        if ($fieldsService->getFieldByHandle('bookDescription')) {
            $fieldValues['bookDescription'] = '<p>This is a book about what happens when you stop performing your beliefs and start living them. It\'s about the distance between what you say matters and what your hands actually do. And it\'s about what you find when you close that gap — not perfection, but something honest. Something that feels like coming home.</p><p><em>The Light Inside the Tunnel</em> was written for anyone who\'s ever sat in the dark and wondered if there\'s a point to all of this. There is. But it\'s not where you were told to look.</p>';
        }
        if ($fieldsService->getFieldByHandle('ctaText')) {
            $fieldValues['ctaText'] = 'Discover the book';
        }
        if ($fieldsService->getFieldByHandle('ctaUrl')) {
            $fieldValues['ctaUrl'] = '/the-book';
        }
        if ($fieldsService->getFieldByHandle('pullQuote')) {
            $fieldValues['pullQuote'] = 'Spirit is not above us. It is between us.';
        }
        if ($fieldsService->getFieldByHandle('pullQuoteAttribution')) {
            $fieldValues['pullQuoteAttribution'] = 'Sebastian Matthew Nadeau';
        }

        $entry->setFieldValues($fieldValues);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to save Book Overview: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Seeded Book Overview (homepage).\n";
        }
    }

    private function seedAboutTheBook(): void
    {
        $entry = Entry::find()->section('aboutTheBook')->one();
        if (!$entry) {
            echo "About the Book section not found — skipping.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        $fieldValues = [];

        if ($fieldsService->getFieldByHandle('synopsis')) {
            $fieldValues['synopsis'] = '<p class="text-lead">Most philosophy books ask you to think differently. This one asks you to <em>live</em> differently — and then notice what changes.</p><p><em>The Light Inside the Tunnel</em> starts with a simple observation: the things you practice are the things you actually believe. Everything else is decoration. Your intentions, your declarations, your carefully worded values — they don\'t count until they reach your hands. Until they show up in what you do on a Tuesday afternoon when no one is watching.</p><p>That\'s not a comfortable idea. But it\'s an honest one. And this book is more interested in honesty than comfort.</p>';
        }
        if ($fieldsService->getFieldByHandle('audienceText')) {
            $fieldValues['audienceText'] = '<p>This book is for you if you\'ve ever sat up at 3 AM wondering whether the life you\'re living is actually yours. If you\'ve felt the distance between who you are and who you\'re pretending to be — and you\'re tired of pretending.</p><p>It\'s for people who are suspicious of easy answers but still want answers. People who\'ve read the self-help books and found them thin. People who sense that philosophy should be something you <em>do</em>, not something you study.</p><p>It\'s not for everyone. It\'s not trying to be. But if something on this page made you pause — even for a second — it might be for you.</p>';
        }
        if ($fieldsService->getFieldByHandle('ctaText')) {
            $fieldValues['ctaText'] = 'Get the book';
        }
        if ($fieldsService->getFieldByHandle('ctaUrl')) {
            $fieldValues['ctaUrl'] = '/get-the-book';
        }

        $entry->setFieldValues($fieldValues);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to save About the Book: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Seeded About the Book.\n";
        }
    }

    private function seedAuthorBio(): void
    {
        $entry = Entry::find()->section('authorBio')->one();
        if (!$entry) {
            echo "Author Bio section not found — skipping.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        $fieldValues = [];

        if ($fieldsService->getFieldByHandle('authorName')) {
            $fieldValues['authorName'] = 'Sebastian Matthew Nadeau';
        }
        if ($fieldsService->getFieldByHandle('authorLocation')) {
            $fieldValues['authorLocation'] = 'Ottawa, Canada';
        }
        if ($fieldsService->getFieldByHandle('shortBio')) {
            $fieldValues['shortBio'] = 'Sebastian Matthew Nadeau is a graphic designer and philosopher from Ottawa, Canada. He wrote this book because he\'d been in the tunnel — and because the light he found there wasn\'t what anyone had promised him it would be. It was better. It was real.';
        }
        if ($fieldsService->getFieldByHandle('fullBio')) {
            $fieldValues['fullBio'] = '<p>Sebastian Matthew Nadeau is an introspective thinker, writer, graphic designer, and web developer from Ottawa, Canada. He values relationships, education, philosophy, and creative expression. His reflections grow out of conversations, solitude, and lived experiences.</p><p>When he was a child, his elementary school teacher called him a philosopher. She noticed something most people don\'t notice in kids — a deep curiosity about life that went past the usual questions. That curiosity never went away. Over the years, Sebastian has spoken with people from many walks of life, learning from their perspectives while forming his own conclusions.</p><p>He believes that success is relative to each individual, and that true fulfillment comes from peace, virtue, and harmony. Character, to him, is formed through virtue — by how we engage with the world, remain true to our values, and live in balance with nature.</p><p>At times, he has felt the weight of loneliness and the search for meaning. Writing has been his way of finding clarity and peace.</p>';
        }
        if ($fieldsService->getFieldByHandle('designBackground')) {
            $fieldValues['designBackground'] = '<p>Sebastian runs <a href="https://skylightdesigns.ca" target="_blank" rel="noopener">Skylight Designs</a>, where he\'s spent years thinking about how to make things clear, beautiful, and true to what they represent. In design, he learned that form and content aren\'t two things — they\'re one thing seen from different angles. A logo that doesn\'t match the company it represents is a lie, no matter how beautiful it is.</p><p>The same turned out to be true for a life. Consistencialism grew directly out of that insight — what you practice is what you believe, what you make is who you are. That\'s why <em>The Light Inside the Tunnel</em> is a designed object, not just a collection of ideas. Every choice — the typography, the spacing, the structure — was made with the same care he brings to his design work.</p><p>Because if the book argues that practice matters more than intention, then the book itself had better practice what it preaches.</p>';
        }
        if ($fieldsService->getFieldByHandle('motivation')) {
            $fieldValues['motivation'] = 'These pages are less about me, and more about the hope that others may find a light for themselves within them.';
        }

        $entry->setFieldValues($fieldValues);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to save Author Bio: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Seeded Author Bio.\n";
        }
    }

    public function safeDown(): bool
    {
        echo "m260310_100200_seed_singles cannot be reverted.\n";
        return false;
    }
}
