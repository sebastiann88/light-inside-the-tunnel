# Light Inside the Tunnel — Technical Architecture

**Platform:** Craft CMS 5
**Local Dev:** DDEV (Docker-based)
**PHP:** 8.2+
**Database:** MySQL 8.0
**Date:** 2026-03-10

---

## 1. Content Model

### 1.1 Singles (one-off pages)

#### Book Overview (`bookOverview`)
- **URI:** `/`  (homepage)
- **Fields:**
  - `heroHeadline` — Plain Text
  - `heroSubheadline` — Plain Text
  - `heroImage` — Asset (single)
  - `bookDescription` — Rich Text (CKEditor)
  - `pullQuote` — Plain Text
  - `pullQuoteAttribution` — Plain Text
  - `bookCoverImage` — Asset (single)
  - `ctaText` — Plain Text (e.g. "Get the Book")
  - `ctaUrl` — URL field (links to purchase)
  - `featuredQuotes` — Entries (related Quotes)
  - `featuredChapters` — Entries (related Chapters)

#### About the Book (`aboutTheBook`)
- **URI:** `/the-book`
- **Fields:**
  - `synopsis` — Rich Text (CKEditor)
  - `audienceText` — Rich Text ("Who is this book for?")
  - `bookDetails` — Table field (label, value) — page count, ISBN, publisher, formats
  - `excerptText` — Rich Text (CKEditor) — 1-2 sample passages
  - `consistencialismSection` — Rich Text (CKEditor) — "What is Consistencialism?" (rendered with `id="consistencialism"` anchor)
  - `relatedChapters` — Entries (related Chapters for listing)
  - `ctaText` — Plain Text
  - `ctaUrl` — URL field

#### Author Bio (`authorBio`)
- **URI:** `/about-the-author`
- **Fields:**
  - `authorPhoto` — Asset (single)
  - `authorName` — Plain Text
  - `authorLocation` — Plain Text
  - `shortBio` — Plain Text (one-liner for use elsewhere)
  - `fullBio` — Rich Text (CKEditor)
  - `designBackground` — Rich Text (CKEditor) — Skylight Designs connection
  - `motivation` — Rich Text (CKEditor) — why the book was written
  - `socialLinks` — Table field (platform, url, icon)

#### Consistencialism — PHASE 2
> For MVP, Consistencialism content lives as a section within About the Book
> with a `#consistencialism` anchor. Standalone single deferred to Phase 2.

#### Contact — PHASE 2
> For MVP, contact is a mailto link + social links in the footer.
> Standalone contact page deferred to Phase 2.

### 1.2 Channels

#### Chapters (`chapters`)
- **URI:** `/chapters/{slug}`
- **Fields:**
  - `chapterNumber` — Number
  - `partNumber` — Number (1–4, for grouping into Parts)
  - `partTitle` — Plain Text (e.g. "Part I: Foundations")
  - `chapterSummary` — Plain Text (short summary for listings)
  - `chapterContent` — Rich Text (CKEditor) — full or excerpt text
  - `keyQuote` — Plain Text
  - `relatedContributions` — Entries (related Philosophical Contributions)
  - `chapterImage` — Asset (optional)

#### Quotes (`quotes`)
- **URI:** none (no detail pages — displayed in context)
- **Fields:**
  - `quoteText` — Plain Text
  - `attribution` — Plain Text
  - `sourceChapter` — Entries (related Chapter, single)
  - `contextNote` — Plain Text (optional, e.g. "On why love is an action")
  - `isFeatured` — Lightswitch (for homepage/highlight use)

#### Philosophical Contributions (`contributions`)
- **URI:** `/contributions/{slug}`
- **Fields:**
  - `contributorName` — Plain Text (philosopher/thinker name)
  - `era` — Plain Text (e.g. "Ancient Greek", "20th Century")
  - `contributionSummary` — Rich Text (CKEditor)
  - `keyQuote` — Plain Text
  - `quoteAttribution` — Plain Text
  - `relatedChapters` — Entries (related Chapters)
  - `contributorImage` — Asset (optional)

#### Testimonials/Press (`testimonials`)
- **URI:** none (displayed in context, possibly a `/praise` listing page)
- **Fields:**
  - `testimonialText` — Rich Text (CKEditor)
  - `reviewerName` — Plain Text
  - `reviewerTitle` — Plain Text (e.g. "Professor of Philosophy, U of Ottawa")
  - `source` — Plain Text (publication name, optional)
  - `sourceUrl` — URL (optional)
  - `rating` — Number (optional, 1-5)
  - `isFeatured` — Lightswitch

#### Blog/Updates (`blog`)
- **URI:** `/blog/{slug}`
- **Fields:**
  - `blogContent` — Rich Text (CKEditor)
  - `excerpt` — Plain Text
  - `featuredImage` — Asset (single)
  - `blogCategory` — Categories (related)
  - `relatedChapters` — Entries (related Chapters, optional)

### 1.3 Category Groups

#### Blog Categories (`blogCategories`)
- Fields: just title (default)
- Example categories: Philosophy, Writing Process, Events, Media

#### Parts (`parts`)
- Used for grouping chapters into book parts
- Fields: `partNumber` (Number), `partDescription` (Plain Text)
- Note: Alternative approach — use the `partNumber` field on Chapters directly and group in templates via Twig. This is simpler and avoids an extra relation. **Recommended: use field-based grouping.**

### 1.4 Globals

#### Purchase Links (`purchaseLinks`)
- **Fields:**
  - `purchaseOptions` — Table field (storeName, storeUrl, storeIcon, isPrimary)
  - Example rows: Amazon, Indigo, Author's site, Kindle, etc.

#### Site Settings (`siteSettings`)
- **Fields:**
  - `siteLogo` — Asset
  - `siteLogoAlt` — Asset (dark mode variant, optional)
  - `footerText` — Plain Text
  - `copyrightText` — Plain Text
  - `socialLinks` — Table field (platform, url)
  - `newsletterHeadline` — Plain Text
  - `newsletterSubtext` — Plain Text
  - `newsletterProvider` — Plain Text (e.g. "mailchimp", "convertkit")
  - `newsletterFormAction` — Plain Text (provider embed/API endpoint)

---

## 2. Template Structure

```
templates/
├── _layouts/
│   └── base.twig              # HTML shell, head, nav, footer
├── _partials/
│   ├── nav.twig               # Site navigation
│   ├── footer.twig            # Site footer
│   ├── hero.twig              # Homepage hero
│   ├── quote-card.twig        # Reusable quote display
│   ├── chapter-card.twig      # Chapter listing card
│   ├── contribution-card.twig # Philosopher card
│   ├── testimonial-card.twig  # Testimonial display
│   ├── blog-card.twig         # Blog post card
│   ├── purchase-cta.twig      # Purchase buttons block
│   ├── newsletter-signup.twig # Email signup form (email service integration)
│   └── seo-meta.twig          # SEO meta tags partial
├── index.twig                 # Homepage (Book Overview single)
├── the-book.twig              # About the Book single
├── about-the-author.twig      # Author Bio single
├── consistencialism.twig      # Consistencialism philosophy single (PHASE 2)
├── chapters/
│   ├── index.twig             # Chapter listing (grouped by Part)
│   └── _entry.twig            # Individual chapter detail
├── contributions/
│   ├── index.twig             # All philosophical contributions
│   └── _entry.twig            # Individual contribution
├── praise.twig                # Testimonials/press listing
├── blog/
│   ├── index.twig             # Blog listing
│   └── _entry.twig            # Individual blog post
├── purchase.twig              # Purchase/buy page
├── contact.twig               # Contact page single (PHASE 2)
├── quotes/
│   └── index.twig             # Quotes browsing page
└── 404.twig                   # Custom 404 page
```

### Template conventions
- **Base layout** uses Twig `{% block %}` inheritance
- **Partials** are included with `{% include '_partials/name' %}`
- **Entry templates** use `_entry.twig` convention for Craft's automatic routing
- **Eager loading** on all relation and asset fields to avoid N+1 queries

---

## 3. Frontend Approach

### CSS: Custom (no Tailwind)
**Rationale:** The author is a graphic designer. The minimalist aesthetic, precise typography, and warm visual tone call for hand-crafted CSS with full control. Tailwind's utility-first approach adds noise to markup for a site that prioritizes elegant simplicity.

- **CSS Custom Properties** for design tokens (colors, fonts, spacing scale)
- **CSS Grid + Flexbox** for layout
- **`clamp()`** for fluid typography (no breakpoint jumps)
- **Logical properties** (`margin-inline`, `padding-block`) for clean spacing
- **Single stylesheet** — site is small enough to avoid CSS splitting
- **BEM-lite naming** — `.hero`, `.hero__title`, `.hero--home`

### Typography system (per design-system.md)
- **Body:** Lora (serif) — 400, 400i, 700
- **Headings:** Jost (geometric sans) — 300, 400
- **UI/Nav:** Jost — 400, 500
- **Quotes:** Lora italic, `--text-lg`
- **Scale:** 1.333 ratio (perfect fourth), base 18px desktop / 16px mobile
- **Max line length:** 38em (`--width-reading`)
- Self-hosted via `@font-face` for performance (no Google Fonts CDN) — **confirmed final**

### Color palette (per design-system.md)
- **Background:** `#FAF6F0` (`--color-cream`)
- **Text:** `#2C2825` (`--color-charcoal`)
- **Accent:** `#C4973B` (`--color-gold`) — links, highlights, CTAs
- **Accent hover:** `#A37E2E` (`--color-gold-dark`) — meets AA contrast
- **Secondary text:** `#4A4543` (`--color-charcoal-light`)
- **Tertiary/borders:** `#8C8580` (`--color-warm-gray`)
- **Cards/sections:** `#F0EBE3` (`--color-cream-dark`)
- **Dark sections (hero/footer):** `#1A1714` (`--color-tunnel`) with `#E8E2D8` text

### JavaScript: Minimal
- **No framework.** Vanilla JS only.
- Small enhancements: smooth scroll, mobile nav toggle, lazy loading
- Possibly Alpine.js if interactivity needs grow (newsletter form, filters)
- All JS deferred/async, <5KB total target

---

## 4. Plugin Stack

| Plugin | Purpose | Priority |
|--------|---------|----------|
| **SEOmatic** | Meta tags, OpenGraph, sitemaps, structured data | Required |
| **CKEditor** | Rich text editing for content fields | Required |
| **Imager-X** | Image transforms, WebP/AVIF generation, srcset | Required |
| **Navigation** | Flexible menu management | Nice-to-have |
| **Blitz** | Full-page static caching for performance | Recommended |
| **Formie** | Contact/newsletter forms | Required |

### Plugin notes
- CKEditor is Craft 5's officially supported rich text plugin
- SEOmatic handles all meta, OG, Twitter cards, JSON-LD structured data
- Imager-X generates responsive image transforms at build/request time
- Blitz is recommended for production — serves static HTML, huge performance win for a content site

---

## 5. Asset Handling

### Images
- **Volumes:** Local filesystem for dev, S3/DO Spaces for production
- **Transforms via Imager-X:**
  - Hero images: 1920w, 1200w, 800w, 400w (WebP + AVIF + fallback JPG)
  - Content images: 1200w, 800w, 400w
  - Thumbnails: 600w, 300w
- **Lazy loading:** Native `loading="lazy"` on all below-fold images
- **Aspect ratios:** Set via CSS `aspect-ratio` to prevent layout shift

### Fonts
- Self-hosted in `web/fonts/` directory
- Subset to Latin characters to reduce file size
- `font-display: swap` for fast text rendering
- Preloaded via `<link rel="preload">` for critical fonts

---

## 6. SEO & Performance

### SEO
- SEOmatic handles meta tags, OpenGraph, Twitter Cards
- JSON-LD structured data: Book schema, Person schema (author), Article schema (blog)
- Semantic HTML throughout (`<article>`, `<nav>`, `<main>`, `<aside>`)
- Clean URL structure: `/chapters/finding-your-light`, `/blog/writing-update`
- XML sitemap via SEOmatic
- `robots.txt` configured for production

### Performance targets
- **Lighthouse score:** 95+ across all categories
- **First Contentful Paint:** <1.5s
- **Total page weight:** <500KB (excluding images)
- **Core Web Vitals:** All green

### Performance strategy
- Blitz static caching in production
- Self-hosted fonts (no external requests)
- Minimal JS (<5KB)
- Responsive images with modern formats (WebP/AVIF)
- Critical CSS inlined in `<head>`
- Preconnect/preload for critical resources

---

## 7. Development Environment (DDEV)

### Setup
```bash
# Initialize DDEV
ddev config --project-type=craftcms --docroot=web --php-version=8.2

# Start environment
ddev start

# Install Craft CMS 5
ddev composer create-project craftcms/craft .

# Install plugins
ddev composer require nystudio107/craft-seomatic
ddev composer require craftcms/ckeditor
ddev composer require spacecatninja/imager-x

# Run Craft installer
ddev craft install
```

### DDEV config highlights
- PHP 8.2
- MySQL 8.0
- Node.js (if build step needed for CSS minification)
- Mailhog for email testing

---

## 8. Deployment Considerations

### Recommended hosting
- **Servd.host** — Craft CMS-optimized hosting (easiest path)
- **DigitalOcean** — App Platform or Droplet with Forge/Ploi
- **Render / Railway** — Container-based, works well with Craft

### Deployment approach
- Git-based deployment (push to deploy)
- Composer install on server (no vendor in repo)
- `craft up` command runs migrations and applies project config
- **Project Config** (`config/project/`) tracked in Git — this is the source of truth for content model
- Environment variables for secrets (DB credentials, keys)
- Asset volumes on S3/DO Spaces in production

### Environment-specific config
- `.env` for environment variables (not in Git)
- `config/general.php` — Craft general config with environment overrides
- `config/db.php` — Database config from env vars
- Separate environments: local (DDEV) → staging → production

---

## 9. Accessibility

- Semantic HTML structure
- ARIA labels where needed (nav, interactive elements)
- Color contrast ratio ≥ 4.5:1 (WCAG AA)
- Keyboard navigation support
- Skip-to-content link
- Alt text on all images (enforced via Craft field validation)
- Focus styles visible and styled
- Reduced motion media query respected

---

## 10. File/Directory Structure (Project Root)

```
light-inside-the-tunnel/
├── .ddev/                    # DDEV configuration
├── config/
│   ├── general.php           # Craft general config
│   ├── db.php                # Database config
│   ├── app.php               # App-level config
│   ├── project/              # Project Config YAML (Git-tracked)
│   └── seomatic/             # SEOmatic config
├── modules/                  # Custom Craft modules (if needed)
├── storage/                  # Craft storage (not in Git)
├── templates/                # Twig templates (see Section 2)
├── web/
│   ├── index.php             # Craft entry point
│   ├── css/
│   │   └── style.css         # Main stylesheet
│   ├── js/
│   │   └── main.js           # Minimal JS
│   ├── fonts/                # Self-hosted typefaces
│   └── uploads/              # Local asset volume (dev only)
├── docs/                     # Project documentation
├── composer.json
├── composer.lock
├── .env                      # Environment vars (not in Git)
├── .env.example              # Template for env vars
├── .gitignore
└── craft                     # Craft CLI executable
```

---

*This document serves as the technical blueprint for Phase 2 implementation. All content model details will be realized through Craft's Project Config system, ensuring the schema is version-controlled and reproducible across environments.*
