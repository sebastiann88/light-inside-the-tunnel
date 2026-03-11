# Content Strategy & Site Map
## The Light Inside the Tunnel — A Philosophy for the Human Heart

---

## 1. Site Map & Page Structure

### MVP (Launch)
```
Home
├── About the Book (includes Consistencialism section with #consistencialism anchor)
├── About the Author
├── Quotes
└── Get the Book (Purchase)
    Footer: Contact (mailto + social links) | Privacy
```

### Phase 2 (Post-Launch)
```
├── Philosophy / Consistencialism (standalone page — when the term has search traction)
├── Chapters & Excerpts (expanded from teasers on About the Book)
│   ├── Part I: [Part Title]
│   ├── Part II: [Part Title]
│   └── Part III: [Part Title]
└── Blog / Updates
```

### Navigation Labels
- **Primary nav (MVP):** Home | The Book | The Author | Quotes | Get the Book
- **Footer:** Contact | Privacy
- **Note:** "Get the Book" rather than "Buy Now" — warmer, less transactional.
- **Contact** is footer-only for MVP (mailto link + social links). Full contact form is Phase 2 if needed.

---

## 2. Page-by-Page Content Plan

### Home *(MVP)*
**Purpose:** Emotional entry point. Make the reader feel seen. Not a sales page — an invitation.

**Content blocks:**
1. **Hero** — A single compelling line or short passage from the book. No hard sell. Subtext: *you're not alone in the tunnel.* CTA: "Start reading" (links to excerpt or book overview).
2. **The book in a breath** — 2-3 sentences capturing what this book is and who it's for. Personal, not blurby.
3. **A handful of quotes** — 3-4 rotating or curated quotes. Let the philosophy speak for itself.
4. **About Sebastian** — Brief author intro with photo. Warm, human. Link to full bio.
5. **Where to get it** — Simple purchase/availability section. Clean, not pushy.

**SEO target:** "philosophy book about living authentically" / "consistencialism" / "light inside the tunnel book"

---

### About the Book *(MVP)*
**Purpose:** Give the reader a real sense of what they're getting into. Not a dust jacket — a conversation about the book.

**Content blocks:**
1. **Opening hook** — What this book is really about, in plain language.
2. **Who this is for** — Not "target audience." A direct, honest description: anyone who's been in the tunnel. Anyone who's wondered if there's light.
3. **Structure overview** — 5 parts, 16 chapters, 3 prologues, preface, epilogue, and 6 interludes. Each chapter gets a 1-2 line evocative teaser. Full structure and copy in `copy/about-the-book.md`.
4. **Consistencialism section** *(anchor: `#consistencialism`)* — A substantial, standalone-quality explanation of the philosophy. Not a summary — a real conversation about what it means to live consistently with who you truly are. Core principles:
   - You are what you practice.
   - Wisdom is knowing knowledge in practice.
   - The beliefs that reach your hands are the only beliefs that matter.
   - Spirit is not above us. It is between us.
   This section must be good enough to share as a direct link (`/the-book#consistencialism`). When the term gains search traction, this content spins out into its own page (Phase 2).
5. **What readers are saying** — Testimonials/press, if available.

**SEO target:** "the light inside the tunnel book" / "philosophy for the human heart" / "what is consistencialism"

---

### About the Author *(MVP)*
**Purpose:** Sebastian as a real person. Not a bio in third person — a living portrait.

**Content blocks:**
1. **Opening** — First person or close-third. Who Sebastian is, what he does, where he's from (Ottawa, graphic designer at skylightdesigns.ca).
2. **The story behind the book** — Why he wrote it. What tunnel he was in. Keep it honest and specific.
3. **Design meets philosophy** — His background as a graphic designer informs how he thinks about beauty, practice, and craft. The book is a designed object, not just words.
4. **Photo** — A good one. Not a headshot from a stock photo set. Something real.

**SEO target:** "Sebastian Matthew Nadeau" / "Sebastian Nadeau author" / "skylight designs Ottawa"

---

### Chapters & Excerpts *(Phase 2)*
**Purpose:** Let readers taste the book. Each chapter/section gets a short teaser — not a summary, an invitation.
**MVP note:** Chapter teasers live on the About the Book page for launch. This expands into a standalone page in Phase 2 if content volume justifies it.

**Content blocks:**
1. **Part groupings** — Chapters organized by the book's part structure.
2. **Per-chapter entry:**
   - Chapter title
   - A 1-2 sentence teaser (evocative, not descriptive)
   - A key quote from the chapter
   - Optional: a short excerpt (200-400 words)
3. **CTA** — "Keep reading" / "Get the full book"

**Content type for Craft CMS:** Channel — "Chapters" with fields: title, part (category/dropdown), teaser text, key quote, excerpt (rich text), sort order.

**SEO target:** Individual chapter titles, key philosophical concepts

---

### Quotes *(MVP)*
**Purpose:** A curated collection of the book's most powerful lines. Shareable, visual, memorable. This page is the social media engine — the landing page for shared quotes from Instagram/X.

**Content blocks:**
1. **Quote display** — Large typography, generous whitespace. One quote at a time or a flowing page.
2. **Per-quote entry:**
   - Quote text
   - Chapter/section reference
   - Optional: brief context line
3. **Share functionality** — Easy share to social (especially image quotes for Instagram/X).

**Content type for Craft CMS:** Channel — "Quotes" with fields: quote text, attribution/chapter reference, context line, featured (lightswitch).

**SEO target:** Specific quotes (long-tail), "consistencialism quotes"

---

### Philosophy / Consistencialism *(Phase 2)*
**Purpose:** A dedicated space to explain the philosophy on its own terms. For the curious reader who wants to go deeper.
**MVP note:** This content lives as a substantial section on the About the Book page with an anchor link (`#consistencialism`). Spins out into its own page once "consistencialism" has search traction.

**Content blocks:**
1. **What is Consistencialism?** — Plain-language explanation. Not a manifesto. A conversation.
2. **Core principles** — The key ideas, each with a brief explanation:
   - You are what you practice.
   - Wisdom is knowing knowledge in practice.
   - The beliefs that reach your hands are the only beliefs that matter.
   - Spirit is not above us. It is between us.
3. **Philosophical lineage** — Who and what influenced this thinking. Not name-dropping — connecting dots.
4. **Living it** — What Consistencialism looks like in daily life. Concrete, not abstract.
5. **CTA** — "Read the book" / link to chapters.

**Content type for Craft CMS:** Single — or a small channel of "Philosophical Contributions" (name, summary, key quote) if Sebastian wants to reference other thinkers.

**SEO target:** "consistencialism" / "what is consistencialism" / "philosophy of practice"

---

### Get the Book / Purchase *(MVP)*
**Purpose:** Make it easy to get the book. That's it. This is a CTA destination — every page links here.

**Content blocks:**
1. **Book cover image** — High quality.
2. **Formats available** — Print, ebook, audiobook (whatever applies).
3. **Retailer links** — Amazon, Indigo, independent bookstores, direct purchase.
4. **Brief pull quote** — One line to remind them why.

**Content type for Craft CMS:** Global set — "Purchase Links" with fields: retailer name, URL, format, sort order.

**SEO target:** "buy the light inside the tunnel" / "light inside the tunnel book purchase"

---

### Blog / Updates *(Phase 2)*
**Purpose:** A space for Sebastian to continue the conversation. Not a content mill — genuine reflections, updates, and expansions on the book's ideas.
**MVP note:** Deferred until Sebastian has concrete content ready. An empty blog is worse than no blog.

**Content blocks:**
1. **Post listing** — Title, date, excerpt, featured image.
2. **Individual post** — Full rich text with images.
3. **Categories** — Light taxonomy: Reflections, Updates, Behind the Book.

**Content type for Craft CMS:** Channel — "Blog" with fields: title, body (rich text), excerpt, featured image, category.

**SEO target:** Varies per post — long-tail philosophical and personal keywords.

---

### Contact *(Footer only for MVP)*
**Purpose:** A simple way to reach Sebastian.

**MVP implementation:** Mailto link + social links in the site footer. Warm microcopy: "Got a thought? I'd like to hear it."
**Phase 2:** Could expand to a simple form page (Formie or Freeform plugin) if volume warrants it.

---

## 3. Content Types Summary (for Craft CMS Modeling)

### MVP Content Types
| Content Type | Craft Type | Key Fields |
|---|---|---|
| Homepage | Single (URI: `/`) | Hero text, intro text, featured quotes (relation), author preview snippet |
| About the Book | Single (URI: `/the-book`) | Body (rich text), consistencialism section, chapter teasers, testimonials (relation) |
| About the Author | Single (URI: `/the-author`) | Body (rich text), author photo (asset) |
| Quotes | Channel | Quote text, chapter ref (relation), context note, featured (lightswitch) |
| Purchase Links | Global Set | Repeater/matrix: retailer name, URL, format |
| Testimonials | Channel | Quote text, author name, source, date |

### Phase 2 Content Types
| Content Type | Craft Type | Key Fields |
|---|---|---|
| Chapters | Channel | Title, partNumber (number), teaser, key quote, excerpt (rich text), sort order |
| Philosophy | Single | Body (rich text) — expanded from About the Book section |
| Philosophical Contributions | Channel | Name, summary, key quote |
| Blog | Channel | Title, body, excerpt, featured image, category |
| Contact | Single | Intro text + embedded form (Formie/Freeform) |

---

## 4. Tone of Voice Guidelines

### The voice is:
- **Warm** — Like talking to a friend who's been through it. Not performatively casual, but genuinely approachable.
- **Honest** — No inflated claims. No "this book will change your life." Let readers decide that.
- **Personal** — First person where appropriate. Sebastian's voice, not a publisher's voice.
- **Grounded** — Philosophy that lives in the body, not in the clouds. Concrete examples over abstract principles.
- **Occasionally funny** — Not forced humor. The kind of humor that comes from being honest about being human.

### The voice is NOT:
- Academic or jargon-heavy
- Self-help cheerful ("You've got this!")
- Dark or brooding (the tunnel has light in it, remember)
- Salesy or urgent ("Limited time!" "Don't miss out!")
- Preachy or moralizing

### Sentence style:
- Short sentences. Direct.
- Questions are welcome — they invite the reader in.
- Fragments are fine when they land.
- Avoid semicolons; they feel academic here.

### Example copy (hero):

> You are what you practice.
> Not what you intend. Not what you declare.
>
> This is a book about what happens when you start living that way.

### CTA language:
- "Start reading" (not "Buy now")
- "Keep going" (not "Read more")
- "Get the book" (not "Purchase")
- "Say hello" (not "Contact us")
- "Go deeper" (not "Learn more")

---

## 5. SEO Keyword Targets by Page

### MVP Pages
| Page | Primary Keywords | Secondary Keywords |
|---|---|---|
| Home | light inside the tunnel, consistencialism | philosophy book, human heart, authentic living |
| About the Book | the light inside the tunnel book, what is consistencialism | philosophy for the human heart, consistencialism philosophy |
| About the Author | Sebastian Matthew Nadeau, Sebastian Nadeau author | skylight designs, Ottawa author |
| Quotes | consistencialism quotes | philosophy quotes, wisdom quotes, authentic living quotes |
| Get the Book | buy light inside the tunnel | where to buy, book purchase |

### Phase 2 Pages
| Page | Primary Keywords | Secondary Keywords |
|---|---|---|
| Philosophy | what is consistencialism, consistencialism | philosophy of practice, authentic living philosophy |
| Chapters | [individual chapter titles] | philosophy excerpts, book excerpts |
| Blog | [varies per post] | philosophical reflections, book updates |

---

## 6. Content Dependencies

### MVP
- **Homepage copy** depends on: design system (layout/typography decisions), final chapter structure
- **About the Book (incl. Consistencialism section)** depends on: confirmed chapter list and part structure from Sebastian
- **About the Author** depends on: input from Sebastian on what to include/exclude
- **Quotes** depends on: curated quote selection from the book
- **Get the Book page** depends on: confirmed retailers and formats

### Phase 2
- **Chapters page** depends on: confirmed chapter list, excerpt permissions
- **Philosophy page** depends on: search traction for "consistencialism"
- **Blog** depends on: Sebastian having concrete content ready to publish

---

*Document prepared by Content Writer. Revised after team discussion — MVP scope agreed with Contrarian Stakeholder.*
*Ready for review by Designer, Developer, and PM.*
