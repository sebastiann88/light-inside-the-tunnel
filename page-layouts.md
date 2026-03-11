# Page Layout Concepts

> All layouts reference tokens from `design-tokens.css` and principles from `design-system.md`.
> Mobile-first. Layouts described at mobile, then desktop enhancements.

---

## 1. Home Page

**Goal:** Emotional entry point. "You're not alone in the tunnel."

### Layout Structure

```
┌─────────────────────────────────────────────┐
│                 HERO SECTION                 │
│          (full-width, dark tunnel bg)        │
│                                              │
│              [sparse, warm light             │
│               gradient at center]            │
│                                              │
│          "You are what you practice.         │
│           Not what you intend.               │
│           Not what you declare."             │
│                                              │
│             [ Start reading → ]              │
│                                              │
├─────────────────────────────────────────────┤
│          THE BOOK IN A BREATH               │
│    (cream bg, --width-reading, centered)     │
│                                              │
│    2-3 sentences. What this is. Who it's     │
│    for. Lora body text, generous padding.    │
│                                              │
│          ◆ (gold diamond divider)            │
│                                              │
├─────────────────────────────────────────────┤
│            FEATURED QUOTES                   │
│     (cream-dark bg, --width-content)         │
│                                              │
│   ┌─────────┐  ┌─────────┐  ┌─────────┐    │
│   │ Quote 1 │  │ Quote 2 │  │ Quote 3 │    │
│   │         │  │         │  │         │    │
│   │ Lora    │  │ Lora    │  │ Lora    │    │
│   │ italic  │  │ italic  │  │ italic  │    │
│   │ --lg    │  │ --lg    │  │ --lg    │    │
│   │         │  │         │  │         │    │
│   │ Ch. ref │  │ Ch. ref │  │ Ch. ref │    │
│   └─────────┘  └─────────┘  └─────────┘    │
│                                              │
│   Mobile: single column, swipeable           │
│   Desktop: 3-column grid                     │
│                                              │
├─────────────────────────────────────────────┤
│           ABOUT THE AUTHOR                   │
│     (cream bg, --width-content)              │
│                                              │
│   ┌──────────┐                               │
│   │  Author  │  "Sebastian Matthew Nadeau    │
│   │  Photo   │   is a graphic designer       │
│   │  (warm,  │   and philosopher from        │
│   │  real)   │   Ottawa, Canada..."          │
│   └──────────┘                               │
│                                              │
│   Mobile: photo stacked above text           │
│   Desktop: photo left, text right            │
│                                              │
│              [ Meet the author → ]           │
│                                              │
├─────────────────────────────────────────────┤
│          GET THE BOOK                        │
│     (cream-dark bg, --width-reading)         │
│                                              │
│   Book cover       Format & retailer links   │
│   (centered)       simply listed             │
│                                              │
│             [ Get the book → ]               │
│                                              │
├─────────────────────────────────────────────┤
│          NEWSLETTER SIGNUP                   │
│     (cream-dark bg, --width-reading)         │
│                                              │
│   "New reflections, updates, and the         │
│    occasional quiet thought."                │
│   [ Your email ] [ Join → ]                  │
│   "No spam. Just light."                     │
│                                              │
├─────────────────────────────────────────────┤
│               FOOTER                         │
│          (dark tunnel bg)                     │
│                                              │
│   Compact newsletter · Nav · Copyright       │
│   "Designed by Skylight Designs"             │
│                                              │
└─────────────────────────────────────────────┘
```

### Design Notes — Home

- **Hero:** Full viewport height on mobile, ~80vh on desktop. Background: `--color-tunnel` with a subtle radial gradient of warm gold at center (the "light"). Text centered, Jost 300 at `--text-4xl`. CTA is a primary gold button.
- **Transitions:** Hero text fades in on load (400ms). Scroll down reveals sections with gentle fade-up.
- **Quotes section:** Cards on `--color-cream-dark`, Lora italic, gold left border. On mobile, horizontal scroll snap. On desktop, 3-column grid with `--space-6` gap.
- **Author section:** Asymmetric — photo takes ~40% width on desktop. Photo has subtle warm shadow. Text is body-sized Lora.
- **Purchase teaser:** Minimal. Book cover + links. Not a full purchase page — just enough.

### Spacing

- Hero → Book intro: `--space-9`
- Between all sections: `--space-9` desktop, `--space-7` mobile
- Internal section padding: `--space-7` vertical

---

## 2. About the Book

**Goal:** A conversation about the book, not a dust jacket.

### Layout Structure

```
┌─────────────────────────────────────────────┐
│              PAGE HEADER                     │
│     (cream bg, --width-reading, centered)    │
│                                              │
│     Jost 300, --text-3xl                     │
│     "The Light Inside the Tunnel"            │
│     Subtitle in --color-warm-gray            │
│                                              │
├─────────────────────────────────────────────┤
│            OPENING HOOK                      │
│     (--width-reading, centered)              │
│                                              │
│   Lora --text-lg, generous leading.          │
│   "This is a book about..." — direct,       │
│   plain language, inviting.                  │
│                                              │
│          ◆                                   │
│                                              │
├─────────────────────────────────────────────┤
│     WHAT IS CONSISTENCIALISM?        #anchor │
│     (cream-dark bg, full-width band)         │
│     (content at --width-reading)             │
│     id="consistencialism"                    │
│                                              │
│     Jost 300, --text-2xl heading             │
│     "What is Consistencialism?"              │
│                                              │
│   Lora body text. The philosophy explained   │
│   in plain language. 3-4 paragraphs. This    │
│   is a substantial, clearly-delineated       │
│   section — not a passing mention.           │
│                                              │
│   Core principles as a quiet list:           │
│   · You are what you practice.               │
│   · Wisdom is knowing knowledge in practice. │
│   · The beliefs that reach your hands are    │
│     the only beliefs that matter.            │
│   · Spirit is not above us. It is between us.│
│                                              │
│   │ "The beliefs that reach your hands       │
│   │  are the only beliefs that matter."      │
│   (gold-left blockquote)                     │
│                                              │
│   [ Go deeper → ] (links to full book)       │
│                                              │
├─────────────────────────────────────────────┤
│            WHO THIS IS FOR                   │
│     (cream bg, --width-reading)              │
│                                              │
│   Direct address. "If you've ever..."        │
│   Not marketing speak. A hand extended.      │
│                                              │
├─────────────────────────────────────────────┤
│          STRUCTURE OVERVIEW                  │
│     (--width-content)                        │
│                                              │
│   Part I ────── Title                        │
│     Ch 1 · Ch 2 · Ch 3                      │
│                                              │
│   Part II ───── Title                        │
│     Ch 4 · Ch 5 · Ch 6                      │
│                                              │
│   Part III ──── Title                        │
│     Ch 7 · Ch 8 · Ch 9                      │
│                                              │
│   Clean, minimal. Gold accent on part        │
│   divider lines. Chapter titles link to      │
│   excerpts.                                  │
│                                              │
├─────────────────────────────────────────────┤
│          TESTIMONIALS                        │
│     (--width-content)                        │
│                                              │
│   If available. Simple blockquote style,     │
│   stacked vertically. Name + source below.   │
│                                              │
├─────────────────────────────────────────────┤
│         CTA BAND                             │
│     (cream-dark bg)                          │
│                                              │
│     "Ready?"                                 │
│     [ Get the book → ]                       │
│                                              │
└─────────────────────────────────────────────┘
```

### Design Notes — About the Book

- **Long-form reading layout:** Everything centered at `--width-reading` (38em). This is a reading page.
- **Consistencialism section** (`#consistencialism` anchor) is a visually distinct cream-dark band — full-width background with content at `--width-reading`. This gives it clear separation so anchor links feel intentional. The heading ("What is Consistencialism?") is Jost 300 at `--text-2xl`. Core principles are styled as a quiet, spaced-out list — not bullet-heavy, just each principle on its own line with `--space-3` between them.
- **Pull quotes** break up the text rhythmically — every 3-4 paragraphs, a gold-bordered blockquote.
- **Structure overview** uses a clean typographic layout, not cards. Part titles in Jost 300, chapter titles in Lora. Gold horizontal rules as dividers.
- **Testimonials:** Only if they exist. No placeholder "Coming soon" — that feels empty.

---

## 3. About the Author

**Goal:** Sebastian as a real person. Warm, human, honest.

### Layout Structure

```
┌─────────────────────────────────────────────┐
│              AUTHOR HERO                     │
│     (full-width, cream-dark bg)              │
│                                              │
│   ┌──────────────┐                           │
│   │              │  "Sebastian Matthew       │
│   │   Full       │   Nadeau"                 │
│   │   Author     │                           │
│   │   Photo      │   Jost 300, --text-3xl    │
│   │   (warm,     │                           │
│   │   natural    │   "Graphic designer.      │
│   │   light)     │    Philosopher.           │
│   │              │    Ottawa, Canada."        │
│   └──────────────┘                           │
│                                              │
│   Mobile: photo full-width, text below       │
│   Desktop: 50/50 split, photo left           │
│                                              │
├─────────────────────────────────────────────┤
│            THE STORY                         │
│     (--width-reading, centered)              │
│                                              │
│   First person or close-third narrative.     │
│   Why he wrote the book. What tunnel he      │
│   was in. Lora body text, generous spacing.  │
│                                              │
│   Pull quote from the author mid-section.    │
│                                              │
├─────────────────────────────────────────────┤
│         DESIGN MEETS PHILOSOPHY              │
│     (cream-dark bg band)                     │
│     (--width-reading, centered)              │
│                                              │
│   How being a graphic designer shapes his    │
│   thinking about beauty, practice, craft.    │
│                                              │
│   Optional: 2-3 small images of design       │
│   work, displayed in a simple row.           │
│                                              │
├─────────────────────────────────────────────┤
│         CONNECT                              │
│     (--width-reading)                        │
│                                              │
│   "Find Sebastian at skylightdesigns.ca"     │
│   Social links (if applicable)               │
│   [ Say hello → ] (links to contact)         │
│                                              │
└─────────────────────────────────────────────┘
```

### Design Notes — About the Author

- **Photo is essential.** Should feel candid, warm-lit. Not a corporate headshot. This page lives or dies on the photo.
- **50/50 hero split** on desktop gives equal weight to image and identity. On mobile, photo goes full-width above.
- **Body text:** Long-form reading. Same `--width-reading` column as About the Book — consistency across reading pages.
- **Design work images:** Small, not portfolio-style. Just enough to show he's a visual person. Optional.

---

## 4. Quotes Page

**Goal:** A beautiful, browsable collection. Each quote should feel like a quiet moment.

### Layout Structure

```
┌─────────────────────────────────────────────┐
│              PAGE HEADER                     │
│     (--width-reading, centered)              │
│                                              │
│     "Words from the tunnel"                  │
│     Jost 300, --text-3xl                     │
│                                              │
├─────────────────────────────────────────────┤
│           FEATURED QUOTE                     │
│     (full-width cream-dark band)             │
│                                              │
│     Large Lora italic, --text-2xl            │
│     centered, generous vertical padding      │
│     (--space-9 top and bottom)               │
│                                              │
│     "You are what you practice.              │
│      Not what you intend.                    │
│      Not what you declare."                  │
│                                              │
│     — Chapter 1                              │
│                                              │
│     [ Share ↗ ]                              │
│                                              │
├─────────────────────────────────────────────┤
│            QUOTE GRID                        │
│     (--width-wide)                           │
│                                              │
│   ┌────────────────┐  ┌────────────────┐    │
│   │                │  │                │    │
│   │  "Quote text   │  │  "Quote text   │    │
│   │   here..."     │  │   here. This   │    │
│   │                │  │   one is longer │    │
│   │  — Ch. 3       │  │   and takes    │    │
│   │  [ Share ↗ ]   │  │   more space." │    │
│   │                │  │                │    │
│   └────────────────┘  │  — Ch. 7       │    │
│   ┌────────────────┐  │  [ Share ↗ ]   │    │
│   │                │  │                │    │
│   │  "Short one."  │  └────────────────┘    │
│   │                │  ┌────────────────┐    │
│   │  — Ch. 12      │  │  ...           │    │
│   │  [ Share ↗ ]   │  └────────────────┘    │
│   └────────────────┘                         │
│                                              │
│   Mobile: single column, full-width cards    │
│   Desktop: masonry-style 2-column grid       │
│                                              │
├─────────────────────────────────────────────┤
│         CTA BAND                             │
│                                              │
│     "These are just fragments.               │
│      The book is the whole."                 │
│     [ Get the book → ]                       │
│                                              │
└─────────────────────────────────────────────┘
```

### Design Notes — Quotes

- **Layout adapts to content volume:**
  - **Under ~15 quotes:** Single column, full-width cards, vertically stacked. Each quote gets the full stage — more like reading a poem than browsing a grid. More intimate, emotionally resonant.
  - **15+ quotes:** 2-column layout using CSS `columns: 2` (not CSS Grid masonry — universal browser support). Quotes of different lengths coexist naturally.
  - Developer should implement both and switch based on quote count.
- **Quote cards:** `--color-cream-dark` background, `--space-5` padding, gold left border (2px). Lora italic at `--text-base` to `--text-lg` depending on length.
- **Featured quote** at top is larger, centered, on a cream-dark band — the "hero" of this page. Present in both layouts.
- **Share button:** Copy-to-clipboard for MVP. Subtle, small share icon. Styled social image generation is Phase 2.
- **No pagination for MVP.** Load all quotes on one page (there won't be hundreds). If the collection grows, add "load more" later.
- **Filtering** by chapter/part could come later. For now, chronological or curated order.

---

## 5. Purchase Page

**Goal:** Make it easy. No friction, no pressure.

### Layout Structure

```
┌─────────────────────────────────────────────┐
│              PURCHASE HERO                   │
│     (cream bg, --width-content, centered)    │
│                                              │
│   ┌──────────────┐                           │
│   │              │  The Light Inside         │
│   │  Book Cover  │  the Tunnel               │
│   │  (large,     │                           │
│   │  high-res,   │  A Philosophy for the     │
│   │  subtle      │  Human Heart              │
│   │  shadow)     │                           │
│   │              │  by Sebastian Matthew     │
│   │              │  Nadeau                    │
│   └──────────────┘                           │
│                                              │
│   Mobile: cover centered above text          │
│   Desktop: cover left (~40%), text right     │
│                                              │
├─────────────────────────────────────────────┤
│          FORMAT & RETAILER LINKS             │
│     (--width-content, centered)              │
│                                              │
│   Print                                      │
│   ┌─────────────────────────────────────┐   │
│   │  Amazon        [ Get it → ]         │   │
│   │  Indigo         [ Get it → ]         │   │
│   │  Independent    [ Get it → ]         │   │
│   └─────────────────────────────────────┘   │
│                                              │
│   Ebook                                      │
│   ┌─────────────────────────────────────┐   │
│   │  Kindle        [ Get it → ]         │   │
│   │  Apple Books   [ Get it → ]         │   │
│   └─────────────────────────────────────┘   │
│                                              │
│   Clean rows, not cards. Subtle borders.     │
│   Gold accent on hover.                      │
│                                              │
├─────────────────────────────────────────────┤
│          PULL QUOTE                          │
│     (cream-dark bg band)                     │
│                                              │
│   A single powerful quote from the book.     │
│   Lora italic, --text-xl, centered.          │
│   Reminds you why you're here.               │
│                                              │
├─────────────────────────────────────────────┤
│          TESTIMONIALS                        │
│     (--width-reading, if available)          │
│                                              │
│   2-3 testimonials, simple blockquote        │
│   style. Name + source.                      │
│                                              │
├─────────────────────────────────────────────┤
│          FOOTER                              │
└─────────────────────────────────────────────┘
```

### Design Notes — Purchase

- **Book cover is the star.** Large, high-quality image with a subtle `--shadow-lg` to give it depth — like it's sitting on a table.
- **Retailer list** is simple rows, not a grid of logos. Retailer name on the left, format tag, link on the right. Clean and scannable. Rows separated by `--color-warm-gray-light` borders.
- **No price displayed** (prices vary by retailer and region). Just link to the retailer.
- **Pull quote section** is a gentle emotional reinforcement — not a hard sell. One line, beautifully set.
- **Testimonials** only if real. No "Review coming soon" placeholders.
- This page should feel **trustworthy and unhurried.** No countdown timers, no "Only 3 left!" energy.

---

## 6. Global Components

### Navigation

```
Mobile:
┌──────────────────────────────┐
│  ☰  Light Inside the Tunnel │
└──────────────────────────────┘

Hamburger opens a full-screen overlay:
┌──────────────────────────────┐
│                          ✕   │
│                              │
│     The Book                 │
│     The Author               │
│     Quotes                   │
│     Get the Book             │
│                              │
│     Blog · Contact           │
│                              │
└──────────────────────────────┘

Desktop:
┌──────────────────────────────────────────────────────────┐
│  Light Inside the Tunnel   The Book  The Author          │
│                            Quotes              [Get →]   │
└──────────────────────────────────────────────────────────┘
```

- **Logo/title:** "Light Inside the Tunnel" in Jost 400, `--text-sm`, uppercase, `--color-charcoal`. Subtle, not shouting.
- **Nav links:** Jost 400, `--text-xs`, uppercase, letter-spacing `0.06em`. `--color-charcoal-light`, gold on hover.
- **MVP nav items:** The Book | The Author | Quotes | Get the Book. "Philosophy" lives as an anchor section (`#consistencialism`) on The Book page. "Read" (Chapters/Excerpts) is Phase 2.
- **CTA in nav:** "Get the Book" styled as a small secondary button (border style).
- **Mobile overlay:** Full-screen, `--color-cream` background, centered nav links at `--text-xl`. Fade transition.
- **Scroll behavior:** Nav has a subtle backdrop blur + border-bottom when scrolled past hero. Sticky on desktop.

### Footer

```
┌──────────────────────────────────────────────────────────┐
│                     (--color-tunnel bg)                   │
│                                                          │
│     Light Inside the Tunnel                              │
│     A Philosophy for the Human Heart                     │
│                                                          │
│     The Book · The Author · Quotes                       │
│     Blog · Contact · Privacy                             │
│                                                          │
│     ───────────────────────────────                      │
│                                                          │
│     © 2026 Sebastian Matthew Nadeau                      │
│     Designed by Skylight Designs                         │
│                                                          │
└──────────────────────────────────────────────────────────┘
```

- **Dark tunnel background** bookends the site — mirrors the hero. The site begins and ends in the tunnel.
- **Text:** `--color-tunnel-text` (#E8E2D8). Links lighten on hover.
- **Simple, centered layout.** No multi-column footer complexity.
- **Gold divider line** between nav links and copyright.

---

## 7. Responsive Behavior Summary

| Element          | Mobile (<768px)          | Desktop (≥1024px)        |
|------------------|--------------------------|--------------------------|
| Hero text        | `--text-3xl`             | `--text-4xl`             |
| Body font base   | 16px                     | 18px                     |
| Section spacing  | `--space-7` (48px)       | `--space-9` (96px)       |
| Quote cards      | Single column            | 2-3 column grid/masonry  |
| Author photo     | Full-width, stacked      | 50/50 or 40/60 split     |
| Book cover       | Centered above text      | Left-aligned, text right |
| Nav              | Hamburger → overlay      | Horizontal inline        |
| Content width    | Full width - 32px        | `--width-reading` (38em) |
| Footer           | Single column, centered  | Same, slightly larger    |

---

## 8. Newsletter Signup Component

Appears in two locations: homepage (above footer) and footer itself (compact version).

### Homepage Newsletter Section

```
├─────────────────────────────────────────────┤
│          STAY IN THE LIGHT                   │
│     (cream-dark bg, full-width band)         │
│     (content at --width-reading)             │
│                                              │
│     "New reflections, updates, and the       │
│      occasional quiet thought."              │
│     Jost 300, --text-xl, centered            │
│                                              │
│     ┌──────────────────┐ ┌──────────┐       │
│     │  Your email       │ │ Join  →  │       │
│     └──────────────────┘ └──────────┘       │
│                                              │
│     Jost --text-xs, --color-warm-gray:       │
│     "No spam. Just light."                   │
│                                              │
├─────────────────────────────────────────────┤
```

- **Placement:** Between the last content section and footer on the homepage
- **Input:** `--color-cream` background (lighter than the band), 1px `--color-warm-gray-light` border, `--radius-sm`
- **Button:** Primary gold style, inline with the input on desktop, full-width stacked on mobile
- **Focus state:** Input border shifts to `--color-gold`
- **Copy tone:** Warm, low-pressure. Not "Subscribe to our newsletter" — more like an invitation
- **Privacy note:** Small text below, links to privacy policy

### Footer Newsletter (Compact)

```
│     "Stay in the light."                     │
│     ┌──────────────┐ ┌────────┐             │
│     │  Email        │ │ Join → │             │
│     └──────────────┘ └────────┘             │
```

- Same input/button styling but smaller (`--text-sm`)
- Single line on desktop, stacked on mobile
- Sits above the footer nav links

### Design Notes — Newsletter

- **No heavy marketing energy.** This is a personal invitation, not a lead gen funnel.
- **Success state:** Input replaced with "Welcome in." in Lora italic, `--color-gold`. Fades in gently.
- **Error state:** Subtle red-warm tone below input. Not alarming.
- **Form integration:** Connects to chosen email service (Mailchimp, ConvertKit, etc.) via API or embedded form.

---

## 9. Page Load & Scroll Animations

Standard server-rendered page loads with per-section fade-up on scroll (IntersectionObserver + CSS).

- Sections fade up: `opacity 0 → 1`, `translateY(8px → 0)` over 400ms
- Stagger child elements by 50ms for gentle cascade
- Trigger at 15% visibility
- Respect `prefers-reduced-motion` — all animations disabled

---

## 10. Phase 2 Page Layout Guidance

These pages are not in MVP scope but will follow established patterns. Notes for the developer to proceed with confidence:

### Chapters Listing (`/chapters`)

- Follow the same pattern as the "Structure Overview" section on About the Book page
- Page header: Jost 300, `--text-3xl`, centered
- Parts as major sections, each with a Jost heading + gold horizontal rule
- Chapter entries: title (Lora, linked), teaser text (Lora `--text-sm`, `--color-charcoal-light`), key quote
- Content at `--width-content` to allow slightly wider layout for the listing
- CTA band at bottom

### Individual Chapter Page (`/chapters/[slug]`)

- `--width-reading` centered column — identical to blog post / long-form reading pattern
- Page header: chapter title in Jost 300 `--text-3xl`, part reference in `--color-warm-gray` below
- Body: Lora `--text-base`, `--leading-body`
- Pull quotes from the chapter interspersed
- Previous/Next chapter navigation at bottom (simple text links, gold accent)

### Blog Post (`/blog/[slug]`)

- Same `--width-reading` centered column as chapter pages
- Date in Jost `--text-xs`, `--color-warm-gray`, uppercase
- Title in Jost 300 `--text-3xl`
- Featured image (if present) at `--width-content`, with `--radius-base`
- Body in Lora, same as all reading pages

### Contact (`/contact`)

- `--width-reading` centered
- Warm intro line: "Got a thought? I'd like to hear it."
- Simple form: Name, Email, Message fields
- Form inputs: `--color-cream-dark` background, 1px `--color-warm-gray-light` border, `--radius-sm`
- Focus state: border shifts to `--color-gold`
- Submit: primary gold button
- Social links below form if applicable

---

*Layouts created by Designer — updated with team feedback.*
