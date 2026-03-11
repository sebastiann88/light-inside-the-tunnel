# Light Inside the Tunnel — Design System

> "A quiet room with a warm lamp." — The site should feel like a safe, warm space for someone searching at 3 AM.

---

## 1. Color Palette

### Core Colors

| Token                | Hex       | Usage                                      |
|----------------------|-----------|---------------------------------------------|
| `--color-cream`      | `#FAF6F0` | Page background                             |
| `--color-cream-dark` | `#F0EBE3` | Subtle section backgrounds, cards           |
| `--color-charcoal`   | `#2C2825` | Primary body text                           |
| `--color-charcoal-light` | `#4A4543` | Secondary text, captions               |
| `--color-warm-gray`  | `#8C8580` | Tertiary text, placeholders, borders        |
| `--color-warm-gray-light` | `#D4CFC9` | Dividers, subtle borders              |

### Accent Colors

| Token                | Hex       | Usage                                      |
|----------------------|-----------|---------------------------------------------|
| `--color-gold`       | `#C4973B` | Primary accent — links, highlights, CTA     |
| `--color-gold-dark`  | `#A37E2E` | Hover states, active accent                 |
| `--color-gold-light` | `#E8D5A8` | Subtle accent backgrounds, selected states  |

### Semantic Colors

| Token                | Hex       | Usage                                      |
|----------------------|-----------|---------------------------------------------|
| `--color-tunnel`     | `#1A1714` | Dark atmospheric sections (hero, footer)    |
| `--color-tunnel-text`| `#E8E2D8` | Light text on dark backgrounds              |

### Dark Section Palette

For the hero and footer — representing the "tunnel" itself:
- Background: `--color-tunnel` (#1A1714)
- Text: `--color-tunnel-text` (#E8E2D8)
- Accent: `--color-gold` (#C4973B) — the light breaking through

### Accessibility Notes

- `--color-charcoal` on `--color-cream`: contrast ratio ~12.5:1 (AAA)
- `--color-gold` on `--color-cream`: contrast ratio ~4.0:1 — use only for large text or decorative elements
- `--color-gold-dark` on `--color-cream`: contrast ratio ~5.2:1 (AA for body text)
- All interactive gold elements should use `--color-gold-dark` for text to meet WCAG AA

---

## 2. Typography

### Font Stack

| Role       | Font Family         | Fallback Stack                        | Weight   |
|------------|---------------------|---------------------------------------|----------|
| Body       | **Lora**            | Georgia, "Times New Roman", serif     | 400, 400i, 700 |
| Headings   | **Jost**            | "Helvetica Neue", Arial, sans-serif   | 300, 400 |
| UI / Nav   | **Jost**            | "Helvetica Neue", Arial, sans-serif   | 400, 500 |

**Why Lora:** Warm, well-balanced serif with excellent readability at body sizes. Has personality without being distracting — feels literary but approachable. Supports italic beautifully for pull quotes.

**Why Jost:** Geometric sans-serif with a humanist warmth. Light weight (300) creates an elegant, airy feel for headings that contrasts beautifully with the richer body serif. Free via Google Fonts.

### Type Scale

Base size: `18px` (1.125rem) on desktop, `16px` (1rem) on mobile.
Scale ratio: ~1.333 (perfect fourth).

| Token        | Size (rem) | Line Height | Weight      | Font  | Usage                     |
|--------------|-----------|-------------|-------------|-------|---------------------------|
| `--text-xs`  | 0.75      | 1.5         | Jost 400    | Jost  | Captions, labels          |
| `--text-sm`  | 0.875     | 1.6         | Lora 400    | Lora  | Small body, footnotes     |
| `--text-base`| 1.0       | 1.75        | Lora 400    | Lora  | Body text                 |
| `--text-lg`  | 1.125     | 1.7         | Lora 400    | Lora  | Lead paragraphs           |
| `--text-xl`  | 1.333     | 1.5         | Jost 300    | Jost  | H4, small section heads   |
| `--text-2xl` | 1.777     | 1.35        | Jost 300    | Jost  | H3                        |
| `--text-3xl` | 2.369     | 1.25        | Jost 300    | Jost  | H2                        |
| `--text-4xl` | 3.157     | 1.15        | Jost 300    | Jost  | H1, hero text             |

### Paragraph Spacing

- Paragraph margin-bottom: `1.5em`
- Max line length (measure): `38em` (~680px at base size) — optimal for reading
- Letter-spacing on headings: `0.01em` (subtle openness)
- Letter-spacing on `--text-xs` caps labels: `0.08em`

---

## 3. Spacing Scale

Based on an 8px grid with a 4px half-step for fine adjustments.

| Token         | Value  | px (at base) |
|---------------|--------|-------------|
| `--space-1`   | 0.25rem | 4px        |
| `--space-2`   | 0.5rem  | 8px        |
| `--space-3`   | 0.75rem | 12px       |
| `--space-4`   | 1rem    | 16px       |
| `--space-5`   | 1.5rem  | 24px       |
| `--space-6`   | 2rem    | 32px       |
| `--space-7`   | 3rem    | 48px       |
| `--space-8`   | 4rem    | 64px       |
| `--space-9`   | 6rem    | 96px       |
| `--space-10`  | 8rem    | 128px      |

### Section Spacing

- Between major page sections: `--space-9` (96px) desktop, `--space-7` (48px) mobile
- Between content blocks within a section: `--space-7` (48px) desktop, `--space-6` (32px) mobile
- Component internal padding: `--space-5` to `--space-6`

---

## 4. Layout & Grid

### Content Width

| Token               | Value   | Usage                        |
|----------------------|---------|------------------------------|
| `--width-reading`    | 38em    | Body text, chapter content   |
| `--width-content`    | 48rem   | General content areas        |
| `--width-wide`       | 64rem   | Cards grids, wider layouts   |
| `--width-max`        | 80rem   | Absolute max container       |

### Grid

- Mobile: Single column, 16px gutters, 16px side padding
- Tablet (768px+): 12-column grid, 24px gutters
- Desktop (1024px+): 12-column grid, 32px gutters
- Content centered within `--width-max`, reading content within `--width-reading`

### Responsive Breakpoints

| Token        | Value   | Name    |
|--------------|---------|---------|
| `--bp-sm`    | 480px   | Small   |
| `--bp-md`    | 768px   | Medium  |
| `--bp-lg`    | 1024px  | Large   |
| `--bp-xl`    | 1280px  | XLarge  |

Mobile-first: all base styles are for the smallest screen. Use `min-width` media queries to scale up.

---

## 5. Component Styles

### Buttons

**Primary Button (CTA)**
- Background: `--color-gold`
- Text: `--color-tunnel` (dark on gold)
- Font: Jost 400, `--text-sm`, uppercase, letter-spacing `0.06em`
- Padding: `--space-3` vertical, `--space-6` horizontal
- Border-radius: `2px` (barely rounded — refined, not playful)
- Hover: background shifts to `--color-gold-dark`, subtle lift (`translateY(-1px)`, light box-shadow)
- Transition: `all 200ms ease`

**Secondary Button**
- Background: transparent
- Border: 1px solid `--color-warm-gray`
- Text: `--color-charcoal`
- Hover: border-color shifts to `--color-gold`, text to `--color-gold-dark`

### Links

- Color: `--color-gold-dark` (meets AA contrast)
- Underline: subtle `text-decoration-color` at 40% opacity
- Hover: underline opacity to 100%, color stays
- No color change on visited (keep the palette clean)

### Cards

- Background: `--color-cream-dark`
- Border: none (rely on background contrast)
- Border-radius: `4px`
- Padding: `--space-5` to `--space-6`
- Hover (if interactive): subtle box-shadow fade in, `transition: box-shadow 300ms ease`

### Blockquotes / Pull Quotes

- Left border: 2px solid `--color-gold`
- Padding-left: `--space-5`
- Font: Lora italic, `--text-lg`
- Color: `--color-charcoal`
- Attribution: Jost 400, `--text-xs`, `--color-warm-gray`, uppercase

### Dividers

- Color: `--color-warm-gray-light`
- Style: 1px solid
- Margin: `--space-7` vertical
- Optional: centered decorative divider using a small gold diamond or dot character

---

## 6. Micro-Interactions & Transitions

### Global Transition

```css
--transition-fast: 150ms ease;
--transition-base: 250ms ease;
--transition-slow: 400ms ease-out;
```

### Page Load

- Content fades in gently: `opacity 0 → 1`, `translateY(8px → 0)` over 400ms
- Stagger child elements by 50ms for a gentle cascade

### Scroll Reveals

- Subtle fade-up on scroll for section entries
- Trigger at 15% visibility
- No bounce, no overshoot — just a quiet arrival

### Hover States

- Buttons: color shift + micro-lift (1px)
- Links: underline opacity transition
- Cards: shadow emergence
- All transitions use `ease` timing — nothing mechanical

### Guiding Principle

> Every animation should feel like a slow breath, not a quick gesture. If you notice the animation, it's too much.

---

## 7. Form Inputs & Newsletter

### Form Inputs

- Background: `--color-cream-dark` (or `--color-cream` when on cream-dark bands)
- Border: 1px solid `--color-warm-gray-light`
- Border-radius: `--radius-sm` (2px)
- Padding: `--space-3` vertical, `--space-4` horizontal
- Font: Lora 400, `--text-base`
- Placeholder color: `--color-warm-gray`
- Focus: border shifts to `--color-gold`, subtle `box-shadow: 0 0 0 2px var(--color-gold-light)`
- Error: border shifts to a warm red (#B5453A), small error text below in same color

### Newsletter Signup

**Two variants:**

**Full (homepage):**
- Cream-dark band, content at `--width-reading`
- Headline: Jost 300, `--text-xl`, centered
- Input + button inline on desktop, stacked on mobile
- Button: primary gold style
- Subtext: Jost `--text-xs`, `--color-warm-gray` — "No spam. Just light."
- Success: input replaced with "Welcome in." in Lora italic, `--color-gold`

**Compact (footer):**
- Single line: "Stay in the light." + email input + button
- Smaller scale (`--text-sm`), inline on desktop, stacked on mobile
- Same input/button styling as full version

---

## 8. Imagery & Iconography

### Photography

- Warm-toned, natural light
- Tunnel/light motifs welcome but not required
- Soft focus, contemplative mood
- No stock-photo energy — authentic or abstract

### Icons

- Line-style, 1.5px stroke
- Warm gray by default, gold on hover/active
- Simple and minimal — only where they genuinely aid navigation
- Prefer text labels over icons when possible

---

## 9. Design Tokens (CSS Custom Properties)

```css
:root {
  /* Colors */
  --color-cream: #FAF6F0;
  --color-cream-dark: #F0EBE3;
  --color-charcoal: #2C2825;
  --color-charcoal-light: #4A4543;
  --color-warm-gray: #8C8580;
  --color-warm-gray-light: #D4CFC9;
  --color-gold: #C4973B;
  --color-gold-dark: #A37E2E;
  --color-gold-light: #E8D5A8;
  --color-tunnel: #1A1714;
  --color-tunnel-text: #E8E2D8;

  /* Typography */
  --font-body: 'Lora', Georgia, 'Times New Roman', serif;
  --font-heading: 'Jost', 'Helvetica Neue', Arial, sans-serif;

  --text-xs: 0.75rem;
  --text-sm: 0.875rem;
  --text-base: 1rem;
  --text-lg: 1.125rem;
  --text-xl: 1.333rem;
  --text-2xl: 1.777rem;
  --text-3xl: 2.369rem;
  --text-4xl: 3.157rem;

  /* Spacing */
  --space-1: 0.25rem;
  --space-2: 0.5rem;
  --space-3: 0.75rem;
  --space-4: 1rem;
  --space-5: 1.5rem;
  --space-6: 2rem;
  --space-7: 3rem;
  --space-8: 4rem;
  --space-9: 6rem;
  --space-10: 8rem;

  /* Layout */
  --width-reading: 38em;
  --width-content: 48rem;
  --width-wide: 64rem;
  --width-max: 80rem;

  /* Transitions */
  --transition-fast: 150ms ease;
  --transition-base: 250ms ease;
  --transition-slow: 400ms ease-out;

  /* Borders */
  --radius-sm: 2px;
  --radius-base: 4px;
  --radius-lg: 8px;
}
```

---

## 10. Accessibility Commitments

- WCAG 2.1 AA minimum for all text contrast
- Focus states: gold outline ring (`2px solid --color-gold`, `2px offset`) on all interactive elements
- Skip-to-content link at top of every page
- Reduced motion: respect `prefers-reduced-motion` — disable all animations/transitions
- Semantic HTML: proper heading hierarchy, landmark regions, ARIA where needed
- Touch targets: minimum 44x44px on mobile

---

## 11. Voice & Tone (Design Implications)

The author's voice is warm, honest, gently humorous, and deeply personal. Design should:
- **Never compete with the words.** Typography and layout serve the text.
- **Create breathing room.** Whitespace is not empty — it's restful.
- **Be confident but gentle.** Bold typographic choices, soft execution.
- **Feel handcrafted.** Even small details (a gold divider, a well-set blockquote) show care.
