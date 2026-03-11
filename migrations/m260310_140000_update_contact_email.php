<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\GlobalSet;

/**
 * Updates contact email from hello@ to sebastian@skylightdesigns.ca.
 */
class m260310_140000_update_contact_email extends Migration
{
    public function safeUp(): bool
    {
        $globalSet = GlobalSet::find()->handle('siteSettings')->one();
        if (!$globalSet) {
            echo "Site Settings not found — skipping.\n";
            return true;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('contactEmail')) {
            echo "contactEmail field not found — skipping.\n";
            return true;
        }

        $globalSet->setFieldValues([
            'contactEmail' => 'sebastian@skylightdesigns.ca',
        ]);

        if (!Craft::$app->getElements()->saveElement($globalSet)) {
            echo "Failed to update contact email: " . implode(', ', $globalSet->getFirstErrors()) . "\n";
        } else {
            echo "Updated contactEmail → sebastian@skylightdesigns.ca\n";
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_140000_update_contact_email cannot be reverted.\n";
        return false;
    }
}
