<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\fields\Dropdown;
use craft\fields\Table;
use craft\fieldlayoutelements\CustomField;
use craft\models\FieldLayout;
use craft\models\FieldLayoutTab;
use craft\fieldlayoutelements\entries\EntryTitleField;

/**
 * Adds chapterType dropdown field and updates purchaseOptions for Snipcart.
 */
class m260310_093600_add_chapter_type_and_update_purchase extends Migration
{
    public function safeUp(): bool
    {
        $fieldsService = Craft::$app->getFields();

        // --- Add chapterType Dropdown field ---
        if (!$fieldsService->getFieldByHandle('chapterType')) {
            $field = new Dropdown();
            $field->name = 'Chapter Type';
            $field->handle = 'chapterType';
            $field->options = [
                ['label' => 'Chapter', 'value' => 'chapter', 'default' => true],
                ['label' => 'Prologue', 'value' => 'prologue', 'default' => false],
                ['label' => 'Preface', 'value' => 'preface', 'default' => false],
                ['label' => 'Interlude', 'value' => 'interlude', 'default' => false],
                ['label' => 'Epilogue', 'value' => 'epilogue', 'default' => false],
            ];
            if (!$fieldsService->saveField($field)) {
                throw new \Exception("Could not save chapterType field: " . implode(', ', $field->getFirstErrors()));
            }
        }

        // --- Add chapterType to the chapters entry type field layout ---
        $sectionsService = Craft::$app->getEntries();
        $chaptersSection = $sectionsService->getSectionByHandle('chapters');
        if ($chaptersSection) {
            $entryTypes = $chaptersSection->getEntryTypes();
            if (!empty($entryTypes)) {
                $entryType = $entryTypes[0];
                $layout = $entryType->getFieldLayout();
                $tabs = $layout->getTabs();

                if (!empty($tabs)) {
                    $tab = $tabs[0];
                    $elements = $tab->getElements();

                    // Add chapterType after the title
                    $chapterTypeField = $fieldsService->getFieldByHandle('chapterType');
                    if ($chapterTypeField) {
                        $newElement = new CustomField($chapterTypeField);
                        // Insert after the first element (title)
                        array_splice($elements, 1, 0, [$newElement]);
                        $tab->setElements($elements);
                        $layout->setTabs([$tab]);
                        $entryType->setFieldLayout($layout);
                        $sectionsService->saveEntryType($entryType);
                    }
                }
            }
        }

        // --- Update purchaseOptions table field for Snipcart ---
        $purchaseField = $fieldsService->getFieldByHandle('purchaseOptions');
        if ($purchaseField && $purchaseField instanceof Table) {
            $purchaseField->columns = [
                'col1' => ['heading' => 'Format', 'handle' => 'formatName', 'type' => 'singleline'],
                'col2' => ['heading' => 'Price', 'handle' => 'price', 'type' => 'singleline'],
                'col3' => ['heading' => 'Currency', 'handle' => 'currency', 'type' => 'singleline'],
                'col4' => ['heading' => 'Snipcart ID', 'handle' => 'snipcartId', 'type' => 'singleline'],
                'col5' => ['heading' => 'Description', 'handle' => 'description', 'type' => 'singleline'],
            ];
            if (!$fieldsService->saveField($purchaseField)) {
                throw new \Exception("Could not update purchaseOptions: " . implode(', ', $purchaseField->getFirstErrors()));
            }
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_093600_add_chapter_type_and_update_purchase cannot be reverted.\n";
        return false;
    }
}
