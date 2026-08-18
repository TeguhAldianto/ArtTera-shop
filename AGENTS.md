# AGENTS.md

## Commands
- **Setup**: `composer run setup`
- **Dev Server**: `composer run dev` (concurrent serve, queue, pail, vite)
- **Test**: `composer run test`
- **Lint / Format**: `./vendor/bin/pint`

## Tech Stack
- **Framework**: Laravel 12 & Filament 3.3
- **Frontend**: Vite, Blade templates, custom CSS (`public/css/style.css`)
- **Architecture**: Service container bindings, modular Agent Skills (`App\Services\AgentSkillManager`)

## UI/UX & Accessibility Standards
- **Interactivity**: Use semantic tags (`<button>`, `<a>`). Icon buttons require `aria-label` and `aria-hidden="true"` on icons. Avoid clickable `<div>` elements.
- **Focus & States**: Explicit `:focus-visible` outlines. Never use `outline: none` without focus replacement. Avoid layout-shifting hover animations (use `opacity` instead of `letter-spacing`).
- **Forms**: Semantic `<label>` associations (`for`/`id`), correct `autocomplete`, `spellCheck={false}` on restricted fields, placeholders ending with `…`.
- **Performance & Transitions**: Explicit transition properties (`transition: color .2s linear, background-color .2s linear`), avoid `transition: all`.

## Operational Gotchas
- Always run `php artisan config:clear` before automated tests if environment changes.
- Filament admin assets can be re-published via `php artisan filament:upgrade`.
