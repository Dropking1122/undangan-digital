---
name: InvitationMusic Table Name
description: Model resolves to wrong table name; explicit declaration needed
---

## Problem
`InvitationMusic` model resolves to `invitation_music` (singular) by Laravel convention,
but the migration created `invitation_musics` (plural).

## Fix
Add explicit table declaration to the model:
```php
protected $table = 'invitation_musics';
```

**Why:** Laravel uses `Str::snake()` + pluralization for class names. `InvitationMusic` → `invitation_music` (only one 's' removed). The migration used standard `Schema::create('invitation_musics', ...)` convention.
