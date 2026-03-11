<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\GlobalSet;

/**
 * Updates purchase options with confirmed pricing: $24.00 CAD.
 */
class m260310_130000_update_purchase_price extends Migration
{
    public function safeUp(): bool
    {
        $globalSet = GlobalSet::find()->handle('purchaseLinks')->one();
        if (!$globalSet) {
            echo "Purchase Links global not found — skipping.\n";
            return true;
        }

        $fieldsService = Craft::$app->getFields();
        if (!$fieldsService->getFieldByHandle('purchaseOptions')) {
            echo "purchaseOptions field not found — skipping.\n";
            return true;
        }

        $options = [
            [
                'col1' => 'Print Edition',
                'col2' => '24.00',
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
            echo "Failed to update purchase options: " . implode(', ', $globalSet->getFirstErrors()) . "\n";
        } else {
            echo "Updated purchase price: Print Edition → \$24.00 CAD. Ebook remains TBD.\n";
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_130000_update_purchase_price cannot be reverted.\n";
        return false;
    }
}
