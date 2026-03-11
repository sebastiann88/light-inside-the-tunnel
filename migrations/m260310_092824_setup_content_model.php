<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\models\Section;
use craft\models\Section_SiteSettings;
use craft\models\EntryType;
use craft\models\FieldLayout;
use craft\models\FieldLayoutTab;
use craft\fieldlayoutelements\CustomField;
use craft\fieldlayoutelements\entries\EntryTitleField;
use craft\fields\PlainText;
use craft\fields\Url as UrlField;
use craft\fields\Email as EmailField;
use craft\fields\Number as NumberField;
use craft\fields\Lightswitch;
use craft\fields\Table;
use craft\fields\Entries as EntriesField;
use craft\fields\Assets as AssetsField;
use craft\fields\Categories as CategoriesField;
use craft\models\CategoryGroup;
use craft\models\CategoryGroup_SiteSettings;
use craft\models\GqlSchema;
use craft\records\GlobalSet as GlobalSetRecord;
use craft\elements\GlobalSet;

/**
 * Sets up the full content model for Light Inside the Tunnel.
 */
class m260310_092824_setup_content_model extends Migration
{
    public function safeUp(): bool
    {
        $this->createFields();
        $this->createCategoryGroups();
        $this->createSingles();
        $this->createChannels();
        $this->createGlobals();

        return true;
    }

    private function createFields(): void
    {
        $fieldsService = Craft::$app->getFields();
        $fields = [
            // --- Text fields ---
            ['PlainText', 'heroHeadline', 'Hero Headline'],
            ['PlainText', 'heroSubheadline', 'Hero Subheadline'],
            ['PlainText', 'pullQuote', 'Pull Quote', ['multiline' => true]],
            ['PlainText', 'pullQuoteAttribution', 'Pull Quote Attribution'],
            ['PlainText', 'ctaText', 'CTA Text'],
            ['PlainText', 'authorName', 'Author Name'],
            ['PlainText', 'authorLocation', 'Author Location'],
            ['PlainText', 'shortBio', 'Short Bio'],
            ['PlainText', 'chapterSummary', 'Chapter Summary', ['multiline' => true]],
            ['PlainText', 'quoteText', 'Quote Text', ['multiline' => true]],
            ['PlainText', 'attribution', 'Attribution'],
            ['PlainText', 'contextNote', 'Context Note'],
            ['PlainText', 'contributorName', 'Contributor Name'],
            ['PlainText', 'era', 'Era'],
            ['PlainText', 'keyQuote', 'Key Quote', ['multiline' => true]],
            ['PlainText', 'quoteAttribution', 'Quote Attribution'],
            ['PlainText', 'reviewerName', 'Reviewer Name'],
            ['PlainText', 'reviewerTitle', 'Reviewer Title'],
            ['PlainText', 'sourceName', 'Source Name'],
            ['PlainText', 'excerpt', 'Excerpt', ['multiline' => true]],
            ['PlainText', 'partTitle', 'Part Title'],
            ['PlainText', 'footerText', 'Footer Text'],
            ['PlainText', 'copyrightText', 'Copyright Text'],
            ['PlainText', 'newsletterHeadline', 'Newsletter Headline'],
            ['PlainText', 'newsletterSubtext', 'Newsletter Subtext'],
            ['PlainText', 'newsletterProvider', 'Newsletter Provider'],
            ['PlainText', 'newsletterFormAction', 'Newsletter Form Action URL'],

            // --- URL fields ---
            ['Url', 'ctaUrl', 'CTA URL'],
            ['Url', 'sourceUrl', 'Source URL'],

            // --- Email fields ---
            ['Email', 'contactEmail', 'Contact Email'],

            // --- Number fields ---
            ['Number', 'chapterNumber', 'Chapter Number'],
            ['Number', 'partNumber', 'Part Number'],
            ['Number', 'rating', 'Rating', ['min' => 1, 'max' => 5]],

            // --- Lightswitch fields ---
            ['Lightswitch', 'isFeatured', 'Is Featured'],
        ];

        foreach ($fields as $fieldDef) {
            $type = $fieldDef[0];
            $handle = $fieldDef[1];
            $name = $fieldDef[2];
            $extra = $fieldDef[3] ?? [];

            if ($fieldsService->getFieldByHandle($handle)) {
                continue;
            }

            $className = match ($type) {
                'PlainText' => PlainText::class,
                'Url' => UrlField::class,
                'Email' => EmailField::class,
                'Number' => NumberField::class,
                'Lightswitch' => Lightswitch::class,
            };

            $field = new $className();
            $field->name = $name;
            $field->handle = $handle;

            if ($type === 'PlainText' && !empty($extra['multiline'])) {
                $field->multiline = true;
                $field->initialRows = 3;
            }
            if ($type === 'Number') {
                if (isset($extra['min'])) $field->min = $extra['min'];
                if (isset($extra['max'])) $field->max = $extra['max'];
            }

            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save field {$handle}: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // --- CKEditor rich text fields ---
        // CKEditor fields use craftcms\ckeditor\Field
        $ckeFields = [
            'bookDescription' => 'Book Description',
            'synopsis' => 'Synopsis',
            'audienceText' => 'Audience Text',
            'excerptText' => 'Excerpt Text',
            'consistencialismSection' => 'Consistencialism Section',
            'fullBio' => 'Full Bio',
            'designBackground' => 'Design Background',
            'motivation' => 'Motivation',
            'chapterContent' => 'Chapter Content',
            'contributionSummary' => 'Contribution Summary',
            'testimonialText' => 'Testimonial Text',
            'blogContent' => 'Blog Content',
            'introText' => 'Intro Text',
        ];

        foreach ($ckeFields as $handle => $name) {
            if ($fieldsService->getFieldByHandle($handle)) {
                continue;
            }
            $field = new \craft\ckeditor\Field();
            $field->name = $name;
            $field->handle = $handle;
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save CKEditor field {$handle}: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // --- Asset fields ---
        $assetFields = [
            'heroImage' => 'Hero Image',
            'bookCoverImage' => 'Book Cover Image',
            'authorPhoto' => 'Author Photo',
            'chapterImage' => 'Chapter Image',
            'contributorImage' => 'Contributor Image',
            'featuredImage' => 'Featured Image',
            'siteLogo' => 'Site Logo',
            'siteLogoAlt' => 'Site Logo Alt',
        ];

        foreach ($assetFields as $handle => $name) {
            if ($fieldsService->getFieldByHandle($handle)) {
                continue;
            }
            $field = new AssetsField();
            $field->name = $name;
            $field->handle = $handle;
            $field->maxRelations = 1;
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save asset field {$handle}: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // --- Entries relation fields ---
        $entriesFields = [
            'featuredQuotes' => 'Featured Quotes',
            'featuredChapters' => 'Featured Chapters',
            'relatedChapters' => 'Related Chapters',
            'relatedContributions' => 'Related Contributions',
            'sourceChapter' => 'Source Chapter',
            'blogCategory' => 'Blog Category',
        ];

        foreach ($entriesFields as $handle => $name) {
            if ($fieldsService->getFieldByHandle($handle)) {
                continue;
            }
            $field = new EntriesField();
            $field->name = $name;
            $field->handle = $handle;
            if ($handle === 'sourceChapter') {
                $field->maxRelations = 1;
            }
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save entries field {$handle}: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // --- Table fields ---
        // Social links
        if (!$fieldsService->getFieldByHandle('socialLinks')) {
            $field = new Table();
            $field->name = 'Social Links';
            $field->handle = 'socialLinks';
            $field->columns = [
                'col1' => ['heading' => 'Platform', 'handle' => 'platform', 'type' => 'singleline'],
                'col2' => ['heading' => 'URL', 'handle' => 'url', 'type' => 'url'],
            ];
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save table field socialLinks: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // Purchase options
        if (!$fieldsService->getFieldByHandle('purchaseOptions')) {
            $field = new Table();
            $field->name = 'Purchase Options';
            $field->handle = 'purchaseOptions';
            $field->columns = [
                'col1' => ['heading' => 'Store Name', 'handle' => 'storeName', 'type' => 'singleline'],
                'col2' => ['heading' => 'URL', 'handle' => 'storeUrl', 'type' => 'url'],
                'col3' => ['heading' => 'Format', 'handle' => 'format', 'type' => 'singleline'],
                'col4' => ['heading' => 'Primary', 'handle' => 'isPrimary', 'type' => 'lightswitch'],
            ];
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save table field purchaseOptions: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // Book details
        if (!$fieldsService->getFieldByHandle('bookDetails')) {
            $field = new Table();
            $field->name = 'Book Details';
            $field->handle = 'bookDetails';
            $field->columns = [
                'col1' => ['heading' => 'Label', 'handle' => 'label', 'type' => 'singleline'],
                'col2' => ['heading' => 'Value', 'handle' => 'value', 'type' => 'singleline'],
            ];
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save table field bookDetails: " . implode(', ', $field->getFirstErrors()));
            }
        }
    }

    private function createCategoryGroups(): void
    {
        $categoriesService = Craft::$app->getCategories();
        $site = Craft::$app->getSites()->getPrimarySite();

        if (!$categoriesService->getGroupByHandle('blogCategories')) {
            $group = new CategoryGroup();
            $group->name = 'Blog Categories';
            $group->handle = 'blogCategories';
            $siteSettings = new CategoryGroup_SiteSettings();
            $siteSettings->siteId = $site->id;
            $siteSettings->hasUrls = false;
            $group->setSiteSettings([$site->id => $siteSettings]);
            if (!$categoriesService->saveGroup($group)) {
                throw new \Exception("Could not save category group blogCategories");
            }
        }
    }

    private function createSingles(): void
    {
        $singles = [
            [
                'name' => 'Book Overview',
                'handle' => 'bookOverview',
                'uri' => '__home__',
                'template' => 'index',
                'fields' => ['heroHeadline', 'heroSubheadline', 'heroImage', 'bookDescription', 'pullQuote', 'pullQuoteAttribution', 'bookCoverImage', 'ctaText', 'ctaUrl', 'featuredQuotes', 'featuredChapters'],
            ],
            [
                'name' => 'About the Book',
                'handle' => 'aboutTheBook',
                'uri' => 'the-book',
                'template' => 'the-book',
                'fields' => ['synopsis', 'audienceText', 'bookDetails', 'excerptText', 'consistencialismSection', 'relatedChapters', 'ctaText', 'ctaUrl'],
            ],
            [
                'name' => 'Author Bio',
                'handle' => 'authorBio',
                'uri' => 'about-the-author',
                'template' => 'about-the-author',
                'fields' => ['authorPhoto', 'authorName', 'authorLocation', 'shortBio', 'fullBio', 'designBackground', 'motivation', 'socialLinks'],
            ],
        ];

        foreach ($singles as $def) {
            $this->createSingleSection($def);
        }
    }

    private function createChannels(): void
    {
        $channels = [
            [
                'name' => 'Chapters',
                'handle' => 'chapters',
                'uri' => 'chapters/{slug}',
                'template' => 'chapters/_entry',
                'fields' => ['chapterNumber', 'partNumber', 'partTitle', 'chapterSummary', 'chapterContent', 'keyQuote', 'relatedContributions', 'chapterImage'],
            ],
            [
                'name' => 'Quotes',
                'handle' => 'quotes',
                'uri' => null,
                'template' => null,
                'fields' => ['quoteText', 'attribution', 'sourceChapter', 'contextNote', 'isFeatured'],
                'titleFormat' => '{quoteText|slice(0, 60)}...',
            ],
            [
                'name' => 'Philosophical Contributions',
                'handle' => 'contributions',
                'uri' => 'contributions/{slug}',
                'template' => 'contributions/_entry',
                'fields' => ['contributorName', 'era', 'contributionSummary', 'keyQuote', 'quoteAttribution', 'relatedChapters', 'contributorImage'],
            ],
            [
                'name' => 'Testimonials',
                'handle' => 'testimonials',
                'uri' => null,
                'template' => null,
                'fields' => ['testimonialText', 'reviewerName', 'reviewerTitle', 'sourceName', 'sourceUrl', 'rating', 'isFeatured'],
            ],
            [
                'name' => 'Blog',
                'handle' => 'blog',
                'uri' => 'blog/{slug}',
                'template' => 'blog/_entry',
                'fields' => ['blogContent', 'excerpt', 'featuredImage', 'relatedChapters'],
            ],
        ];

        foreach ($channels as $def) {
            $this->createChannelSection($def);
        }
    }

    private function createGlobals(): void
    {
        $globals = [
            [
                'name' => 'Purchase Links',
                'handle' => 'purchaseLinks',
                'fields' => ['purchaseOptions'],
            ],
            [
                'name' => 'Site Settings',
                'handle' => 'siteSettings',
                'fields' => ['siteLogo', 'siteLogoAlt', 'footerText', 'copyrightText', 'socialLinks', 'newsletterHeadline', 'newsletterSubtext', 'newsletterProvider', 'newsletterFormAction', 'contactEmail'],
            ],
        ];

        foreach ($globals as $def) {
            $this->createGlobalSet($def);
        }
    }

    private function createSingleSection(array $def): void
    {
        $sectionsService = Craft::$app->getEntries();
        $site = Craft::$app->getSites()->getPrimarySite();

        if ($sectionsService->getSectionByHandle($def['handle'])) {
            return;
        }

        // Create entry type first
        $entryType = new EntryType();
        $entryType->name = $def['name'];
        $entryType->handle = $def['handle'];
        $entryType->hasTitleField = true;
        $entryType->setFieldLayout($this->buildFieldLayout($def['fields']));

        if (!$sectionsService->saveEntryType($entryType)) {
            throw new \Exception("Could not save entry type {$def['handle']}: " . implode(', ', $entryType->getFirstErrors()));
        }

        // Create section
        $section = new Section();
        $section->name = $def['name'];
        $section->handle = $def['handle'];
        $section->type = Section::TYPE_SINGLE;
        $section->setEntryTypes([$entryType]);

        $siteSettings = new Section_SiteSettings();
        $siteSettings->siteId = $site->id;
        $siteSettings->hasUrls = true;
        $siteSettings->uriFormat = $def['uri'];
        $siteSettings->template = $def['template'];
        $siteSettings->enabledByDefault = true;
        $section->setSiteSettings([$site->id => $siteSettings]);

        if (!$sectionsService->saveSection($section)) {
            throw new \Exception("Could not save section {$def['handle']}: " . implode(', ', $section->getFirstErrors()));
        }
    }

    private function createChannelSection(array $def): void
    {
        $sectionsService = Craft::$app->getEntries();
        $site = Craft::$app->getSites()->getPrimarySite();

        if ($sectionsService->getSectionByHandle($def['handle'])) {
            return;
        }

        // Create entry type
        $entryType = new EntryType();
        $entryType->name = $def['name'];
        $entryType->handle = $def['handle'];
        $entryType->hasTitleField = true;

        if (isset($def['titleFormat'])) {
            $entryType->hasTitleField = false;
            $entryType->titleFormat = $def['titleFormat'];
        }

        $entryType->setFieldLayout($this->buildFieldLayout($def['fields']));

        if (!$sectionsService->saveEntryType($entryType)) {
            throw new \Exception("Could not save entry type {$def['handle']}: " . implode(', ', $entryType->getFirstErrors()));
        }

        // Create section
        $section = new Section();
        $section->name = $def['name'];
        $section->handle = $def['handle'];
        $section->type = Section::TYPE_CHANNEL;
        $section->setEntryTypes([$entryType]);

        $siteSettings = new Section_SiteSettings();
        $siteSettings->siteId = $site->id;
        $siteSettings->enabledByDefault = true;

        if ($def['uri']) {
            $siteSettings->hasUrls = true;
            $siteSettings->uriFormat = $def['uri'];
            $siteSettings->template = $def['template'];
        } else {
            $siteSettings->hasUrls = false;
        }

        $section->setSiteSettings([$site->id => $siteSettings]);

        if (!$sectionsService->saveSection($section)) {
            throw new \Exception("Could not save section {$def['handle']}: " . implode(', ', $section->getFirstErrors()));
        }
    }

    private function createGlobalSet(array $def): void
    {
        $globalsService = Craft::$app->getGlobals();

        if ($globalsService->getSetByHandle($def['handle'])) {
            return;
        }

        $globalSet = new GlobalSet();
        $globalSet->name = $def['name'];
        $globalSet->handle = $def['handle'];
        $globalSet->setFieldLayout($this->buildFieldLayout($def['fields']));

        if (!$globalsService->saveSet($globalSet)) {
            throw new \Exception("Could not save global set {$def['handle']}: " . implode(', ', $globalSet->getFirstErrors()));
        }
    }

    private function buildFieldLayout(array $fieldHandles): FieldLayout
    {
        $fieldsService = Craft::$app->getFields();
        $elements = [new EntryTitleField()];

        foreach ($fieldHandles as $handle) {
            $field = $fieldsService->getFieldByHandle($handle);
            if ($field) {
                $elements[] = new CustomField($field);
            }
        }

        $layout = new FieldLayout();
        $tab = new FieldLayoutTab();
        $tab->name = 'Content';
        $tab->layout = $layout;
        $tab->setElements($elements);
        $layout->setTabs([$tab]);

        return $layout;
    }

    public function safeDown(): bool
    {
        echo "m260310_092824_setup_content_model cannot be reverted.\n";
        return false;
    }
}
