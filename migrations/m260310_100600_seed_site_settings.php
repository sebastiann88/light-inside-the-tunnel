<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\GlobalSet;

/**
 * Seeds the Site Settings global set with initial values.
 */
class m260310_100600_seed_site_settings extends Migration
{
    public function safeUp(): bool
    {
        $globalSet = GlobalSet::find()->handle('siteSettings')->one();
        if (!$globalSet) {
            echo "Site Settings global set not found — skipping.\n";
            return true;
        }

        $fieldsService = Craft::$app->getFields();
        $fieldValues = [];

        if ($fieldsService->getFieldByHandle('footerText')) {
            $fieldValues['footerText'] = 'A Philosophy for the Human Heart';
        }
        if ($fieldsService->getFieldByHandle('copyrightText')) {
            $fieldValues['copyrightText'] = '© 2026 Sebastian Matthew Nadeau';
        }
        if ($fieldsService->getFieldByHandle('siteLogoAlt')) {
            $fieldValues['siteLogoAlt'] = 'Light Inside the Tunnel';
        }
        if ($fieldsService->getFieldByHandle('newsletterHeadline')) {
            $fieldValues['newsletterHeadline'] = 'Stay in the light';
        }
        if ($fieldsService->getFieldByHandle('newsletterSubtext')) {
            $fieldValues['newsletterSubtext'] = 'New reflections, quotes, and writing from Sebastian — delivered when there\'s something worth saying. No schedule. No spam. Just honest words.';
        }
        if ($fieldsService->getFieldByHandle('contactEmail')) {
            $fieldValues['contactEmail'] = 'hello@skylightdesigns.ca';
        }

        if (!empty($fieldValues)) {
            $globalSet->setFieldValues($fieldValues);
            if (!Craft::$app->getElements()->saveElement($globalSet)) {
                echo "Failed to save Site Settings: " . implode(', ', $globalSet->getFirstErrors()) . "\n";
            } else {
                echo "Seeded Site Settings global.\n";
            }
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_100600_seed_site_settings cannot be reverted.\n";
        return false;
    }
}
