# Content Strategy & Site Map
## "The Light Inside the Tunnel" — Book Website

**Author:** Sebastian Matthew Nadeau
**Philosophy:** Consistencialism — living consistently with who you truly are
**Tone:** Warm, honest, personal. Not academic. Humor present.
**Audience:** Anyone in their own tunnel at 3 AM looking for light.

---

## Site Map

```
Home
├── About the Book
│   └── Chapters & Excerpts
├── About the Author
├── Consistencialism (Philosophy)
├── Quotes
├── Testimonials & Press
├── Blog / Updates
├── Purchase
└── Contact
```

---

## Page-by-Page Content Plan

### 1. Home
**Purpose:** First impression — communicate what the book is, who it's for, and why it matters.

- Hero section: Book title, subtitle, evocative tagline, book cover image
- Brief intro paragraph (2-3 sentences — warm, inviting)
- Featured quote from the book (rotating or curated)
- "What is Consistencialism?" teaser (1 paragraph + link)
- Social proof strip (testimonial snippet or press mention)
- Primary CTA: Purchase / Read More
- Secondary CTA: Explore chapters

**SEO target:** "The Light Inside the Tunnel book", "Consistencialism", author name

### 2. About the Book
**Purpose:** Deeper dive into what the book covers, its structure, and why it was written.

- Book synopsis (3-4 paragraphs)
- "Who is this book for?" section
- Book details (page count, ISBN, publisher, format availability)
- Chapter listing with brief descriptions
- Excerpt preview (1-2 passages)
- CTA: Purchase

**SEO target:** "philosophy book for everyday life", "personal philosophy book"

### 3. Chapters & Excerpts
**Purpose:** Let readers browse the book's structure and sample the writing.

- Organized by Parts (if the book has parts/sections)
- Each chapter: title, brief summary, optional excerpt
- Pull quotes highlighted visually
- CTA per chapter: "Read more" or "Get the book"

**SEO target:** Individual chapter topics as long-tail keywords

### 4. About the Author
**Purpose:** Build connection and trust. Sebastian is a graphic designer from Ottawa — this is personal.

- Author photo
- Bio (personal, warm — not a CV)
- Connection to Skylight Designs (skylightdesigns.ca)
- Why this book was written (personal motivation)
- Fun/human detail (humor welcome here)

**SEO target:** "Sebastian Matthew Nadeau", "Skylight Designs Ottawa"

### 5. Consistencialism (Philosophy)
**Purpose:** Explain the philosophy for newcomers. This is the intellectual anchor of the site.

- What is Consistencialism? (accessible, non-academic explanation)
- Core principles or tenets
- How it relates to the book
- Philosophical influences/contributions (channel content)
- Invitation to explore further through the book

**SEO target:** "Consistencialism", "Consistencialism philosophy", "what is Consistencialism"

### 6. Quotes
**Purpose:** Shareable, browsable collection of quotes from the book.

- Quote cards with text, chapter reference
- Filterable by theme or chapter
- Share buttons (social media)
- Visual design emphasis — these should be beautiful and shareable

**SEO target:** "Light Inside the Tunnel quotes", "philosophy quotes"

### 7. Testimonials & Press
**Purpose:** Social proof and credibility.

- Reader testimonials (name, brief quote)
- Press mentions or reviews (publication, excerpt, link)
- Endorsements

**SEO target:** "Light Inside the Tunnel reviews"

### 8. Blog / Updates
**Purpose:** Ongoing content, author reflections, book news.

- Blog posts (title, date, excerpt, full content)
- Categories/tags
- Author reflections on Consistencialism in daily life
- Book events, signings, media appearances

**SEO target:** Long-tail philosophy and personal growth keywords

### 9. Purchase
**Purpose:** Convert interest into sales. Clear, simple, no friction.

- Book cover image (large)
- Price and format options (paperback, ebook, audiobook if applicable)
- Purchase links (Amazon, Indigo, local bookstores, direct)
- Brief testimonial or pull quote
- Money-back guarantee or satisfaction note (if applicable)

**SEO target:** "buy Light Inside the Tunnel", "Consistencialism book"

### 10. Contact
**Purpose:** Let readers, press, and event organizers reach Sebastian.

- Simple contact form (name, email, subject, message)
- Or email link
- Social media links
- Press kit download (optional)

---

## Content Types for Craft CMS

| Content Type | Craft Section Type | Key Fields |
|---|---|---|
| Home | Single | hero_tagline, intro_text, featured_quote (relation), cta_text, cta_url |
| About the Book | Single | synopsis, audience_text, book_details (matrix), chapter_list (relation) |
| About the Author | Single | bio, author_photo, motivation_text |
| Consistencialism | Single | explanation, principles (matrix), influences (relation) |
| Chapters | Channel | title, part_number, chapter_number, summary, excerpt, pull_quotes |
| Quotes | Channel | quote_text, attribution, chapter (relation), themes (tags) |
| Philosophical Contributions | Channel | name, summary, key_quote, relevance |
| Testimonials | Channel | reviewer_name, review_text, source, rating, date |
| Blog Posts | Channel | title, body, excerpt, featured_image, categories, tags |
| Purchase Links | Global | links (table: store_name, url, format, price) |
| Contact | Single | intro_text, email |

---

## Navigation Structure

**Primary Nav:** Home | About the Book | Consistencialism | Quotes | Blog | Purchase

**Secondary/Footer Nav:** About the Author | Testimonials | Contact | Privacy Policy

**Mobile:** Hamburger menu with full nav

---

## Tone of Voice Guidelines

1. **Warm, not clinical.** Write like you're talking to a friend at a coffee shop, not lecturing from a podium.
2. **Honest and direct.** No marketing fluff. Say what you mean.
3. **Personal.** Use "I" and "you." This is a conversation.
4. **Humor welcome.** Light touches. The book has humor — the site should too.
5. **Not academic.** Avoid jargon. If you must use a philosophical term, explain it plainly.
6. **Inviting.** The reader should feel welcome, not judged. This is for anyone.

---

## SEO Strategy (High Level)

- **Primary keywords:** "The Light Inside the Tunnel", "Consistencialism", "Sebastian Matthew Nadeau"
- **Secondary keywords:** "philosophy book", "personal philosophy", "philosophy for everyday life"
- **Content approach:** Blog posts targeting long-tail keywords around themes in the book
- **Technical SEO:** Clean URLs, meta descriptions per page, Open Graph tags, structured data (Book schema), XML sitemap
- **Local SEO:** Ottawa, Canada connection via author bio

---

*Document version: 1.0 — Phase 1 Planning*
*Last updated: 2026-03-10*
