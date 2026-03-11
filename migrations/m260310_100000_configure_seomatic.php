<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use nystudio107\seomatic\Seomatic;

/**
 * Configures SEOmatic global meta settings for Light Inside the Tunnel.
 *
 * SEOmatic stores its settings in the database. This migration sets the global
 * defaults programmatically so they're reproducible across environments.
 * Per-page overrides are handled in Twig templates via SEOmatic's API.
 */
class m260310_100000_configure_seomatic extends Migration
{
    public function safeUp(): bool
    {
        // SEOmatic must be installed and enabled
        $plugin = Craft::$app->getPlugins()->getPlugin('seomatic');
        if (!$plugin) {
            echo "SEOmatic not installed — skipping configuration.\n";
            return true;
        }

        // Get the meta bundle for the primary site
        $siteId = Craft::$app->getSites()->getPrimarySite()->id;

        // Configure global SEO settings via SEOmatic's API
        $metaGlobalVars = Seomatic::$plugin->metaContainers->metaGlobalVars;
        if ($metaGlobalVars) {
            $metaGlobalVars->seoTitle = 'The Light Inside the Tunnel';
            $metaGlobalVars->seoDescription = 'A philosophy for the human heart. By Sebastian Matthew Nadeau. You are what you practice — not what you intend.';
            $metaGlobalVars->seoKeywords = 'Consistencialism, philosophy, Sebastian Matthew Nadeau, The Light Inside the Tunnel, practice, belief, human heart';
        }

        // Note: Most SEOmatic configuration is done through the CP.
        // This migration sets baseline defaults. Fine-tuning (social images,
        // JSON-LD schemas, sitemap settings) should be done in the CP after
        // content is entered.
        //
        // Per-page meta is handled in templates using SEOmatic's Twig API:
        //   {% do seomatic.meta.seoTitle("Page Title") %}
        //   {% do seomatic.meta.seoDescription("Description") %}

        echo "SEOmatic global defaults configured.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_100000_configure_seomatic cannot be reverted.\n";
        return false;
    }
}
