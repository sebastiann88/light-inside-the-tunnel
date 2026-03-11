<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;

/**
 * Comprehensive SEOmatic configuration for Light Inside the Tunnel.
 *
 * Sets global meta defaults, social sharing defaults, and site identity.
 * Per-page meta is handled in Twig templates via SEOmatic's API.
 * JSON-LD schemas are rendered inline in templates (WebSite, Book, Person).
 */
class m260310_100700_seomatic_full_config extends Migration
{
    public function safeUp(): bool
    {
        $plugin = Craft::$app->getPlugins()->getPlugin('seomatic');
        if (!$plugin) {
            echo "SEOmatic not installed — skipping configuration.\n";
            return true;
        }

        $siteId = Craft::$app->getSites()->getPrimarySite()->id;

        // --- Global Meta ---
        $metaGlobalVars = \nystudio107\seomatic\Seomatic::$plugin->metaContainers->metaGlobalVars;
        if ($metaGlobalVars) {
            // Core SEO
            $metaGlobalVars->seoTitle = 'The Light Inside the Tunnel';
            $metaGlobalVars->seoDescription = 'A philosophy for the human heart. By Sebastian Matthew Nadeau. You are what you practice — not what you intend.';
            $metaGlobalVars->seoKeywords = 'Consistencialism, philosophy, Sebastian Matthew Nadeau, The Light Inside the Tunnel, authentic living, practice, human heart';

            // Separator for auto-generated titles
            $metaGlobalVars->separatorChar = '—';

            // Open Graph defaults
            $metaGlobalVars->ogType = 'website';
            $metaGlobalVars->ogTitle = '{seomatic.meta.seoTitle}';
            $metaGlobalVars->ogDescription = '{seomatic.meta.seoDescription}';
            $metaGlobalVars->ogSiteName = 'The Light Inside the Tunnel';

            // Twitter Card defaults
            $metaGlobalVars->twitterCard = 'summary_large_image';
            $metaGlobalVars->twitterTitle = '{seomatic.meta.seoTitle}';
            $metaGlobalVars->twitterDescription = '{seomatic.meta.seoDescription}';

            // Robots
            $metaGlobalVars->robots = 'index,follow';
        }

        // --- Site Identity ---
        $metaSiteVars = \nystudio107\seomatic\Seomatic::$plugin->metaContainers->metaSiteVars;
        if ($metaSiteVars) {
            $metaSiteVars->siteName = 'The Light Inside the Tunnel';
            $metaSiteVars->identity = [
                'siteType' => 'Person',
                'computedType' => 'Person',
                'genericName' => 'Sebastian Matthew Nadeau',
                'genericDescription' => 'Author of The Light Inside the Tunnel — A Philosophy for the Human Heart. Graphic designer at Skylight Designs, Ottawa, Canada.',
                'genericUrl' => 'https://skylightdesigns.ca',
                'genericEmail' => 'sebastian@skylightdesigns.ca',
                'genericAddressLocality' => 'Ottawa',
                'genericAddressRegion' => 'Ontario',
                'genericAddressCountry' => 'CA',
            ];
            $metaSiteVars->creator = [
                'siteType' => 'Person',
                'computedType' => 'Person',
                'genericName' => 'Sebastian Matthew Nadeau',
                'genericDescription' => 'Graphic designer and web developer at Skylight Designs',
                'genericUrl' => 'https://skylightdesigns.ca',
            ];
        }

        echo "SEOmatic fully configured: global meta, OG, Twitter, site identity.\n";
        echo "Note: JSON-LD schemas (WebSite, Book, Person) are rendered inline in Twig templates.\n";
        echo "Note: Social sharing images should be uploaded via the CP once available.\n";
        return true;
    }

    public function safeDown(): bool
    {
        echo "m260310_100700_seomatic_full_config cannot be reverted.\n";
        return false;
    }
}
