<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;
use craft\elements\GlobalSet;

/**
 * Seeds remaining MVP copy that was not covered by earlier migrations:
 * - Consistencialism section on About the Book
 * - Author Bio "The Book" section + "In His Own Words" closing (motivation field)
 * - Interlude and Preface chapter entries
 * - chapterType values on all chapter entries
 * - Purchase options global
 */
class m260310_110000_seed_remaining_copy extends Migration
{
    public function safeUp(): bool
    {
        $this->seedConsistencialismSection();
        $this->seedAuthorMotivation();
        $this->seedInterludes();
        $this->seedPreface();
        $this->setChapterTypes();
        $this->seedPurchaseOptions();

        return true;
    }

    /**
     * Seeds the consistencialismSection field on About the Book.
     * This is the longest and most important content section on the site.
     * Source: copy/about-the-book.md — DEFINITIVE VERSION with Sebastian's exact words.
     */
    private function seedConsistencialismSection(): void
    {
        $entry = Entry::find()->section('aboutTheBook')->one();
        if (!$entry) {
            echo "About the Book not found — skipping consistencialism section.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('consistencialismSection')) {
            echo "consistencialismSection field not found — skipping.\n";
            return;
        }

        $html = <<<'HTML'
<h2>Consistencialism &mdash; A Humanistic Philosophy</h2>

<p class="text-lead"><strong>The study of how our thoughts, psyche, and inner emotional state can influence how we form our exterior environments.</strong></p>

<blockquote>
<p>&ldquo;I believe in the soul of humanity.<br>
Love comes from the soul.<br>
When we treat each other with love,<br>
that lifts our spirits,<br>
where we can live in harmony.&rdquo;<br>
&mdash; Sebastian Matthew Nadeau</p>
</blockquote>

<p>We are free to express ourselves authentically, so long as our way of life does not destroy life itself.</p>

<hr>

<h3>The Ten Personal Core Beliefs</h3>

<p><strong>1. I believe in preserving and respecting human dignity.</strong></p>

<p>Every person carries the right to express who they truly are &mdash; their authentic self &mdash; and to contribute to the world from that place. Dignity is not earned through accomplishment or conformity. It is inherent. When we honour someone&rsquo;s dignity, we honour their freedom to exist fully, without condition.</p>

<p><strong>2. I believe life is the pursuit of something we cannot fully reach alone.</strong></p>

<p>Life is the pursuit of something we cannot fully reach alone. Our imperfections are not flaws &mdash; they are the very thing that draw us toward each other. We grow not by achieving perfection, but by sharing the journey with others who are equally incomplete. In that shared striving, we find belonging.</p>

<p><strong>3. I believe that we can all be united, accepted, and loved for our uniqueness.</strong></p>

<p>Each person&rsquo;s identity is a gift &mdash; not something to be corrected or hidden. When we accept others not in spite of their differences but because of them, we build a world where people no longer have to perform a version of themselves to be loved. Belonging should not require becoming someone else.</p>

<p><strong>4. I believe that we are part of nature, and we need to live in nature&rsquo;s natural ecosystem.</strong></p>

<p>The Earth is not a resource to be consumed &mdash; it is a home to be cared for. We belong to nature, not the other way around. Living in balance with the natural world is not a sacrifice; it is a return to something essential. Care for the planet is care for ourselves.</p>

<p><strong>5. I believe that we are all invaluable human beings, and our worth is equally undefiable.</strong></p>

<p>Worth is not measured by productivity, status, or usefulness. Every human being is invaluable &mdash; and that value is equal across all people. It cannot be ranked. It cannot be taken. It can only be recognized &mdash; or failed to be recognized. And that failure is ours, not theirs.</p>

<hr>

<p><strong>6. I believe the beauty of life, is to go out and witness the beauty in the world.</strong></p>

<p>Beauty is not passive. It asks us to go out, to pay attention, and to be changed by what we find. It lives in art, in nature, in a stranger&rsquo;s act of kindness, in a child&rsquo;s unfiltered honesty. Seeking beauty is not indulgence &mdash; it is one of the deepest forms of being alive.</p>

<p><strong>7. I believe the purpose of life, is to do good for everyone, and reduce evil.</strong></p>

<p>Purpose is not found in ambition alone, but in contribution. To live well is to leave the world a little better &mdash; not through grand gestures, but through consistent small ones. Reducing suffering, even in quiet ways, gives a life its shape and meaning.</p>

<p><strong>8. I believe the joy of life, is to share experiences in good company.</strong></p>

<p>Joy is rarely solitary. It blooms in the presence of people we care about &mdash; in shared meals, laughter, silence, adventure. The quality of our lives is measured not by what we accumulate, but by who we experience it with.</p>

<p><strong>9. I believe the meaning of life is about human connection; creating precious moments, for yourself and for others to keep, and to pass on wisdom for future generations.</strong></p>

<p>Meaning is built between people. It lives in the moments we create together &mdash; the ones we carry with us long after they&rsquo;ve passed. And it extends beyond our own lifetime: the wisdom we pass on becomes part of someone else&rsquo;s foundation. Connection is how we outlast ourselves.</p>

<p><strong>10. I believe in the passing of life, you will be remembered for the person you were, not the things you had. You will be honoured for what you left behind, and be reminded for what you took away.</strong></p>

<p>Legacy is not wealth or title. It is character. When a life ends, what remains is the impression left on others &mdash; the kindness given, the courage shown, the truth spoken. And equally, what was taken. We are remembered whole &mdash; for what we gave and for what we cost.</p>

<hr>

<blockquote>
<p>&ldquo;Our external world is formed by our internal values &mdash;<br>
by what we recognize as important and worthy<br>
to live by and build upon.<br>
Be kind to others. Care for our planet.<br>
Spend quality time with those you love.<br>
Create precious experiences,<br>
because they become the memories that shape one&rsquo;s life.&rdquo;<br>
&mdash; Sebastian Matthew Nadeau</p>
</blockquote>

<blockquote>
<p>&ldquo;We are all one among many people, though each unique person shares a spectrum of similar emotions.&rdquo;</p>
</blockquote>
HTML;

        $entry->setFieldValues([
            'consistencialismSection' => $html,
        ]);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to save consistencialism section: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Seeded Consistencialism section on About the Book.\n";
        }
    }

    /**
     * Updates the Author Bio motivation field with the full "The Book" section
     * (philosophical contributions list) and "In His Own Words" closing quotes.
     * Source: copy/about-the-author.md
     */
    private function seedAuthorMotivation(): void
    {
        $entry = Entry::find()->section('authorBio')->one();
        if (!$entry) {
            echo "Author Bio not found — skipping motivation update.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('motivation')) {
            echo "motivation field not found — skipping.\n";
            return;
        }

        $html = <<<'HTML'
<p><em>The Light Inside the Tunnel</em> is Sebastian&rsquo;s first book. In it, he introduces Consistencialism &mdash; a philosophy built not in a university but in grocery stores, on buses, and in conversations with strangers.</p>

<p>Among its contributions:</p>

<ul>
<li><strong>Worth and dignity</strong> &mdash; that worth is inherent and untouchable, but dignity lives between people and depends on whether we choose to see each other. Life is self-evident. People&rsquo;s perceptions are not.</li>
<li><strong>The gardener principle</strong> &mdash; that a just system does not tell people how to grow, but protects the soil so they can bloom on their own.</li>
<li><strong>The practice thesis</strong> &mdash; that you are what you practice, not what you intend, and that the beliefs that reach your hands are the only beliefs that matter.</li>
<li><strong>The relocation of spirit</strong> &mdash; that the spiritual world is not above us but between us.</li>
<li><strong>A redefinition of justice</strong> &mdash; as the preservation of harmony between people, threatened not by evil but by indifference.</li>
<li><strong>A challenge to Maslow</strong> &mdash; that psychological safety comes before physical safety.</li>
<li><strong>The philosophy of compassion</strong> &mdash; that compassion is the ability to see another person as an extension of yourself, so when they are wounded, you cry.</li>
<li><strong>A definition of wisdom</strong> &mdash; wisdom is knowing knowledge in practice.</li>
</ul>

<p>This work is not an autobiography, but a journey &mdash; an attempt to capture what it means to live with dignity, connection, and love.</p>

<hr>

<p>In the end, these pages are less about Sebastian, and more about the hope that others may find a light for themselves within them.</p>

<blockquote>
<p>&ldquo;I believe in the soul of humanity. Love comes from the soul.&rdquo;</p>
</blockquote>

<blockquote>
<p>&ldquo;Live a good life, try to be a good person, and help others when you can. Why am I here? To have fun.&rdquo;</p>
</blockquote>
HTML;

        $entry->setFieldValues([
            'motivation' => $html,
        ]);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to update author motivation: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Updated Author Bio motivation with full contributions + closing quotes.\n";
        }
    }

    /**
     * Seeds the 6 interludes as chapter entries with chapterType = 'interlude'.
     * Source: copy/about-the-book.md — Structure Overview, Interludes section.
     */
    private function seedInterludes(): void
    {
        $sectionsService = Craft::$app->getEntries();
        $section = $sectionsService->getSectionByHandle('chapters');
        if (!$section) {
            echo "Chapters section not found — skipping interludes.\n";
            return;
        }

        $entryTypes = $section->getEntryTypes();
        if (empty($entryTypes)) {
            echo "No entry types for chapters — skipping interludes.\n";
            return;
        }
        $entryType = $entryTypes[0];

        $fieldsService = Craft::$app->getFields();
        $hasChapterType = (bool) $fieldsService->getFieldByHandle('chapterType');
        $hasPartNumber = (bool) $fieldsService->getFieldByHandle('partNumber');
        $hasPartTitle = (bool) $fieldsService->getFieldByHandle('partTitle');
        $hasChapterNumber = (bool) $fieldsService->getFieldByHandle('chapterNumber');
        $hasChapterSummary = (bool) $fieldsService->getFieldByHandle('chapterSummary');

        $interludes = [
            ['title' => 'Heart of a Soldier', 'summary' => ''],
            ['title' => 'The Soldier\'s Song', 'summary' => ''],
            ['title' => 'A Dialogue on Healing', 'summary' => ''],
            ['title' => 'A Dialogue with Socrates', 'summary' => ''],
            ['title' => 'A Second Dialogue with Socrates', 'summary' => ''],
            ['title' => 'A Conversation with a Child', 'summary' => ''],
        ];

        $count = 0;
        foreach ($interludes as $data) {
            $existing = Entry::find()
                ->section('chapters')
                ->title($data['title'])
                ->one();
            if ($existing) {
                continue;
            }

            $entry = new Entry();
            $entry->sectionId = $section->id;
            $entry->typeId = $entryType->id;
            $entry->title = $data['title'];

            $fieldValues = [];
            if ($hasChapterType) {
                $fieldValues['chapterType'] = 'interlude';
            }
            if ($hasPartNumber) {
                $fieldValues['partNumber'] = 0;
            }
            if ($hasPartTitle) {
                $fieldValues['partTitle'] = 'Interludes';
            }
            if ($hasChapterNumber) {
                $fieldValues['chapterNumber'] = 0;
            }
            if ($hasChapterSummary) {
                $fieldValues['chapterSummary'] = $data['summary'];
            }
            $entry->setFieldValues($fieldValues);

            if (!Craft::$app->getElements()->saveElement($entry)) {
                echo "Failed to save interlude '{$data['title']}': " . implode(', ', $entry->getFirstErrors()) . "\n";
            } else {
                $count++;
            }
        }

        echo "Seeded {$count} interludes.\n";
    }

    /**
     * Seeds the Preface ("A Word Before the Journey") as a chapter entry.
     * Source: copy/about-the-book.md — Structure Overview.
     */
    private function seedPreface(): void
    {
        $sectionsService = Craft::$app->getEntries();
        $section = $sectionsService->getSectionByHandle('chapters');
        if (!$section) {
            echo "Chapters section not found — skipping preface.\n";
            return;
        }

        $existing = Entry::find()
            ->section('chapters')
            ->title('A Word Before the Journey')
            ->one();
        if ($existing) {
            echo "Preface already exists — skipping.\n";
            return;
        }

        $entryTypes = $section->getEntryTypes();
        if (empty($entryTypes)) {
            return;
        }
        $entryType = $entryTypes[0];

        $fieldsService = Craft::$app->getFields();

        $entry = new Entry();
        $entry->sectionId = $section->id;
        $entry->typeId = $entryType->id;
        $entry->title = 'A Word Before the Journey';

        $fieldValues = [];
        if ($fieldsService->getFieldByHandle('chapterType')) {
            $fieldValues['chapterType'] = 'preface';
        }
        if ($fieldsService->getFieldByHandle('partNumber')) {
            $fieldValues['partNumber'] = 0;
        }
        if ($fieldsService->getFieldByHandle('partTitle')) {
            $fieldValues['partTitle'] = 'Preface';
        }
        if ($fieldsService->getFieldByHandle('chapterNumber')) {
            $fieldValues['chapterNumber'] = 0;
        }
        if ($fieldsService->getFieldByHandle('chapterSummary')) {
            $fieldValues['chapterSummary'] = 'A quiet moment before the road opens up. What this book is trying to do, and why.';
        }
        $entry->setFieldValues($fieldValues);

        if (!Craft::$app->getElements()->saveElement($entry)) {
            echo "Failed to save preface: " . implode(', ', $entry->getFirstErrors()) . "\n";
        } else {
            echo "Seeded preface entry.\n";
        }
    }

    /**
     * Sets chapterType on all existing chapter entries.
     * Prologues → 'prologue', Epilogue → 'epilogue', regular chapters → 'chapter'.
     */
    private function setChapterTypes(): void
    {
        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('chapterType')) {
            echo "chapterType field not found — skipping.\n";
            return;
        }

        // Prologues (part 0, not interludes or preface)
        $prologueTitles = [
            'Soup, Then a Coat',
            'Groceries with an Official Pep Talk',
            'The Sandwich Trilogy',
        ];
        foreach ($prologueTitles as $title) {
            $entry = Entry::find()->section('chapters')->title($title)->one();
            if ($entry) {
                $entry->setFieldValues(['chapterType' => 'prologue']);
                Craft::$app->getElements()->saveElement($entry);
            }
        }

        // Epilogue
        $epilogue = Entry::find()->section('chapters')->title('A Light Inside the Tunnel')->one();
        if ($epilogue) {
            $epilogue->setFieldValues(['chapterType' => 'epilogue']);
            Craft::$app->getElements()->saveElement($epilogue);
        }

        // Regular chapters (chapterNumber > 0, not already typed)
        $chapters = Entry::find()
            ->section('chapters')
            ->chapterNumber('> 0')
            ->all();
        foreach ($chapters as $chapter) {
            $chapter->setFieldValues(['chapterType' => 'chapter']);
            Craft::$app->getElements()->saveElement($chapter);
        }

        echo "Set chapterType values on all chapter entries.\n";
    }

    /**
     * Seeds the purchaseOptions table on the Purchase Links global.
     * Direct sales model — two formats with placeholder pricing.
     * Source: copy/purchase-page.md
     */
    private function seedPurchaseOptions(): void
    {
        $globalSet = GlobalSet::find()->handle('purchaseLinks')->one();
        if (!$globalSet) {
            echo "Purchase Links global not found — skipping.\n";
            return;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('purchaseOptions')) {
            echo "purchaseOptions field not found — skipping.\n";
            return;
        }

        $options = [
            [
                'col1' => 'Print Edition',
                'col2' => 'TBD',
                'col3' => 'CAD',
                'col4' => '',
                'col5' => 'The Light Inside the Tunnel — A Philosophy for the Human Heart (Paperback)',
            ],
            [
                'col1' => 'Ebook',
                'col2' => 'TBD',
                'col3' => 'CAD',
                'col4' => '',
                'col5' => 'The Light Inside the Tunnel — A Philosophy for the Human Heart (Digital)',
            ],
        ];

        $globalSet->setFieldValues([
            'purchaseOptions' => $options,
        ]);

        if (!Craft::$app->getElements()->saveElement($globalSet)) {
            echo "Failed to save purchase options: " . implode(', ', $globalSet->getFirstErrors()) . "\n";
        } else {
            echo "Seeded purchase options (Print + Ebook, pricing TBD).\n";
        }
    }

    public function safeDown(): bool
    {
        echo "m260310_110000_seed_remaining_copy cannot be reverted.\n";
        return false;
    }
}
