# PIN System

A simple PHP page that's locked behind a PIN. Enter the PIN, get in. No database needed.

- Default PIN: `1200` — change it from the admin page.

## Pages

| File           | What it does                                        |
| -------------- | --------------------------------------------------- |
| `index.php`    | Login page — enter the PIN                          |
| `dashboard.php`| Protected page, only reachable after a valid login  |
| `admin.php`    | Change the PIN (requires the current PIN)           |
| `logout.php`   | Logs you out and sends you back to the login page   |
| `config.php`   | Settings (session options + default PIN hash)       |
| `style.css`    | Styling                                             |

## How it works

- The PIN is never stored in plain text. It's saved as a **bcrypt hash**.
- The current hash lives in `pin.hash`. On first run that file doesn't exist yet, so the default PIN from `config.php` (`1200`) is used.
- Logging in creates a session cookie. `dashboard.php` checks that cookie and redirects to the login page if it's missing or expired.
- Use `admin.php` to set a new PIN — you have to enter the current PIN first. The new PIN is hashed and written to `pin.hash`.

## Deploying on Hostinger

1. Upload the folder to `public_html` (or a subfolder) with FTP or the hPanel file manager.
2. Open your domain — you'll see the PIN page.
3. Go to `admin.php` and change the PIN from the default `1200`.
4. PHP needs permission to write `pin.hash` in this folder. In hPanel the files already run as your account user, so it usually just works. If changing the PIN fails with a permissions error, set the folder permissions to `755` (or `775`).

## Changing the PIN manually (if you can't reach admin)

Generate a hash and save it to `pin.hash`:

```bash
php -r "echo password_hash('yournewpin', PASSWORD_BCRYPT), PHP_EOL;"
```

Copy the output into a file named `pin.hash` (no extra spaces or blank lines).

## Security note

The PIN is checked on the server, so it can't be read from the page source. That's fine for gating access to a simple page, but if you're protecting something sensitive, use real per-user accounts instead of a shared PIN.