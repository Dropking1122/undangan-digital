---
name: Blade JSON-LD at-sign escape
description: JSON-LD @context/@type keys inside Blade templates cause ParseError unless escaped as @@context/@@type
---

## Rule
Any JSON-LD key starting with `@` inside a `<script type="application/ld+json">` block in a Blade template must be escaped as `@@`:
- `"@context"` → `"@@context"`
- `"@type"` → `"@@type"`

**Why:** Blade's compiler treats `@word` as a potential directive. Laravel 11+ ships a `context()` helper, so `@context` compiles to a real PHP call (`context()->has(...)`) that produces an unclosed `if` block — resulting in "unexpected end of file, expecting elseif or else or endif" at runtime even though `php -l` on the Blade file itself passes.

**How to apply:** Whenever adding structured data (JSON-LD, Schema.org) to any `.blade.php` file, escape all `@`-prefixed JSON keys with `@@`. The compiled output renders them back as single `@` in the HTML.
