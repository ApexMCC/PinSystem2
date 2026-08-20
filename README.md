# PIN System

A simple PHP PIN-gated page. Enter the PIN, get in. No database needed.

- **PIN: `1200`** (change it from the Admin page)

## Files

```
index.php      Login — enter the PIN
dashboard.php  Protected page (only with a valid session)
admin.php      Change the PIN (needs the current PIN)
logout.php     Sign out
config.php     Settings + default PIN hash
functions.php  Helpers
style.css      Styling
```

## How it works

- The PIN is stored as a **bcrypt hash** (never plaintext) in `pin.hash` (created the first time you change it). If that file is missing, the default PIN `1200` applies.
- Login creates a session cookie; `dashboard.php` requires it and otherwise redirects to the login.
- Change the PIN at `admin.php` — you must enter the current PIN first. The new PIN is hashed and saved to `pin.hash`.

## Deploy (Hostinger)

1. Upload the whole folder to `public_html` (or a subfolder) via FTP or hPanel File Manager.
2. Open `https://yourdomain.com/` — you'll see the PIN page.
3. Visit `admin.php` and change the PIN from the default `1200`.
4. Make sure PHP can write to the folder so it can create/update `pin.hash` (set folder permissions to `755` or `775`; if using hPanel, the files already run as the account user).

## Changing the PIN manually

If you can't reach the admin page, generate a hash and save it to `pin.hash`:

```bash
php -r "echo password_hash('yourpin', PASSWORD_BCRYPT), PHP_EOL;"
# paste the output into a file named pin.hash (no extra spaces/newlines)
```

Or use an online bcrypt generator and save its output to `pin.hash`.

## Security note

The PIN is verified server-side, so it can't be read from the page source — but for anything truly sensitive, use a real account system instead of a shared PIN.