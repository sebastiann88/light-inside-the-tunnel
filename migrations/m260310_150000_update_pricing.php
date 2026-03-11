<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\GlobalSet;

/**
 * Updates purchase pricing: Print $36.00 CAD, Ebook $24.00 CAD.
 */
class m260310_150000_update_pricing extends Migration
{
    public function safeUp(): bool
    {
        $globalSet = GlobalSet::find()->handle('purchaseLinks')->one();
        if (!$globalSet) {
            echo "Purchase Links global not found — skipping.\n";
            return true;
        }

        $options = [
            [
                'col1' => 'Print Edition',
                'col2' => '36.00',
                'col3' => 'CAD',
                'col4' => '',
                'col5' => 'The Light Inside the Tunnel — A Philosophy for the Human Heart (Paperback)',
            ],
            [
                'col1' => 'Ebook',
                'col2' => '24.00',
                'col3' => 'CAD',
                'col4' => '',
                'col5' => 'The Light Inside the Tunnel — A Philosophy for the Human Heart (Digital)',
            ],
        ];

        $globalSet->setFieldValues([
            'purchaseOptions' => $options,
        ]);

        if (!Craft::$app->getElements()->saveElement($globalSet)) {
            echo "Failed to update pricing: " . implode(', ', $globalSet->getFirstErrors()) . "\n";
        } else {
            echo "Updated pricing: Print → \$36.00 CAD, Ebook → \$24.00 CAD.\n";
        }

        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_150000_update_pricing cannot be reverted.\n";
        return false;
    }
}
