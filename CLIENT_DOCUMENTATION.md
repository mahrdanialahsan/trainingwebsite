# Training Website – Client Documentation

This document describes the functionality of the Training Website, which frontend content you can manage from the admin panel, system settings, installation steps, and how to access the admin area.

---

## 1. Functionality of the Project

The Training Website is a Laravel-based site that provides:

### Public (Frontend) Features

- **Home** – Hero, featured courses, team bios, newsletter signup.
- **About** – Hero, “What We Offer”, “Who We Are”, “Training Means Safety”, team bios, and other editable sections.
- **Courses** – List of courses with thumbnails; each course has a detail page with booking.
- **Book a course** – Users register/login, select a course, accept the waiver, pay via Stripe, and receive confirmation.
- **Trainings** – List of training types; each has facilities, amenities, and optional PDF download.
- **Consulting** – Consulting services content and a “Request Consultation” form (submissions are stored and emailed).
- **Contact** – Contact form; submissions are stored and emailed to the address set in Settings.
- **FAQs** – Filterable FAQs (e.g. General, About Us, Consulting).
- **User account** – Register, login, email verification, password reset, dashboard to view bookings.

### Admin (Backend) Features

- **Dashboard** – Overview of the site.
- **Training & Courses** – Courses, Bookings, Trainings, Waivers.
- **Website Content** – About sections, Bios, FAQs.
- **Consulting** – Consulting page sections and Consultation Requests list.
- **Inquiries** – Contact Messages from the Contact form.
- **Users & Lists** – User accounts and Newsletter Subscribers.
- **System** – Settings (General, Social Media, Payment), and (for Super Admin) Admins management and Change Password.

---

## 2. Frontend Pages You Can Change From Admin

All of these public pages get their main content from the admin panel. What you edit in admin is what visitors see on the site.

| Frontend Page | Admin Section | What You Can Change |
|---------------|---------------|----------------------|
| **Home** (`/`) | **About** (sections), **Bios**, **Courses** | Hero/overview content, team bios and photos, featured courses come from Courses. |
| **About** (`/about`) | **About**, **Bios** | Hero, “What We Offer”, “Who We Are”, “Training Means Safety”, other sections (text, images, videos), team bios and photos. |
| **Courses** (`/courses`, `/courses/{slug}`) | **Courses** | Course title, description, long description, thumbnail image, date, time, price, max participants, status, active/inactive. |
| **Trainings** (`/trainings`, `/trainings/{slug}`) | **Trainings** | Training title, description, facilities, amenities, optional PDF download. |
| **Consulting** (`/consulting`) | **Consulting Sections** | Hero, overview, services, approach, benefits, CTA. Content and structure of the consulting page. |
| **FAQs** (`/faqs`) | **FAQs** | Questions and answers; filter by type (e.g. General, About Us, Consulting). |
| **Contact** (`/contact`) | — | Form is fixed; **Settings** control where submissions are sent (Contact Form Email). |
| **Footer & global** | **Settings** | Tagline, system email, phone, contact form email, social media links (see below). |

**Inquiries you can only view (not edit page content):**

- **Consultation Requests** – Requests from the Consulting page form. View and update status (e.g. Pending, Contacted, Completed).
- **Contact Messages** – Messages from the Contact form. View only.
- **Bookings** – Course bookings. View and update status (e.g. Pending, Confirmed, Cancelled).
- **Subscribers** – Newsletter signups. View and activate/deactivate.

---

## 3. System Requirements & Settings (Admin)

You can configure site-wide behaviour and integrations from the admin panel under **System → Settings**. No code changes are required.

### 3.1 General Settings

| Setting | Purpose |
|--------|---------|
| **Tagline** | Short company tagline (e.g. in footer). |
| **System Email** | Main email shown in footer and on Contact page. |
| **Phone Number** | Phone number shown in footer and Contact page. |
| **Contact Form Email** | Address that receives **Contact form** and **Consultation request** submissions. If empty, System Email is used. |

### 3.2 Social Media Links

Optional URLs; when set, they are used for social icons (e.g. in footer):

- **Facebook**
- **Instagram**
- **YouTube**
- **Twitter**
- **LinkedIn**

Leave a field blank to hide that social link.

### 3.3 Payment Settings (Stripe)

Used for course booking payments:

| Setting | Purpose |
|--------|---------|
| **Stripe Publishable Key** | Public key (starts with `pk_`). |
| **Stripe Secret Key** | Secret key (starts with `sk_`). Keep this private. |
| **Stripe Webhook Secret** | Webhook signing secret (starts with `whsec_`) for the endpoint used by your site. |

**How to get Stripe keys**

1. Log in to [Stripe Dashboard](https://dashboard.stripe.com).
2. Go to **Developers → API keys** and copy **Publishable key** and **Secret key**.
3. For **Webhooks**, go to **Developers → Webhooks**, add an endpoint:
   - URL: `https://yourdomain.com/webhooks/stripe` (replace with your real site URL).
   - Select the events you need (e.g. `checkout.session.completed`).
   - Copy the **Signing secret** and save it in **Stripe Webhook Secret**.

If these are not set, booking payment will not work; the site will show an error on the payment step.

---

## 4. Installation Guide

### 4.1 Server / Environment Requirements

- **PHP** 8.2 or higher (with extensions: BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML).
- **Composer** ([getcomposer.org](https://getcomposer.org)).
- **Node.js** 18+ and **npm** (optional; for building front-end assets with Vite).
- **Database**: MySQL 5.7+ / 8.0+ (or MariaDB equivalent), or SQLite for local use.
- **Web server**: Apache or Nginx, with the document root pointing to the `public_html` folder (see below).

### 4.2 Steps to Install

1. **Upload or clone the project** to your server (e.g. into `trainingwebsite` or your domain’s root).

2. **Install PHP dependencies**
   ```bash
   cd /path/to/trainingwebsite
   composer install --no-dev --optimize-autoloader
   ```
   Use `composer install` if you need dev tools (e.g. for debugging).

3. **Environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit `.env` and set at least:
   - `APP_NAME`, `APP_URL` (your site URL, e.g. `https://yourdomain.com`)
   - Database: `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
   - Mail (for emails): `MAIL_MAILER`, `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`, and your SMTP or mail service settings

4. **Database**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
   This creates tables and seeds initial data (including the default admin user and settings).

5. **Storage link** (for uploads and public files)
   ```bash
   php artisan storage:link
   ```
   If your host does not allow symlinks, point the web-accessible path (e.g. `public_html/storage`) to `storage/app/public` using the method your host supports.

6. **Public directory**  
   The app is set to use **`public_html`** as the public web root (e.g. for cPanel). Ensure:
   - Your domain’s document root is `public_html` inside the project, **or**
   - The server is configured so that requests are routed to `public_html/index.php` (and that `public_html` contains the normal Laravel public files: `index.php`, `build/`, etc.).

7. **Optional – build front-end assets**
   ```bash
   npm ci
   npm run build
   ```
   If you skip this, the site may use CDN fallbacks where configured (e.g. Tailwind). For production, building is recommended.

8. **Permissions**  
   Ensure the web server can read the project and write to `storage/` and `bootstrap/cache/`:
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```
   (Replace `www-data` with your server’s web user if different.)

9. **Optional – caching (production)**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

After installation, open your site URL and go to **Admin** (see Section 5). Change the default admin password and update **Settings** (General, Social Media, Payment) as needed.

---

## 5. Admin URL and Credentials

### Admin URL

- **Login page:** `https://yourdomain.com/admin/login`  
  (Replace `yourdomain.com` with your actual domain.)

- After login you are redirected to the **Dashboard:** `https://yourdomain.com/admin/dashboard`

### Default Admin Credentials

| Field     | Value                |
|----------|----------------------|
| **URL**  | `/admin/login`       |
| **Email**    | `admin@training.com` |
| **Password** | `admin123`           |

**Important:** Change this password as soon as possible after first login:

1. Log in to the admin panel.
2. In the left sidebar, go to **System** and click **Change Password** (or open `/admin/change-password`).
3. Set a strong new password and save.

If you have **Super Admin** access, you can also manage other admin users under **System → Admins**.

---

## Summary

- **Functionality:** Public site for courses, bookings (with Stripe), trainings, consulting, contact, FAQs, and user accounts; admin manages all content and settings.
- **Frontend content:** Home, About, Courses, Trainings, Consulting, and FAQs are editable from the admin sections listed in the table in Section 2.
- **System settings:** General (tagline, emails, phone), Social Media links, and Payment (Stripe) are configured under **Admin → System → Settings**.
- **Installation:** PHP 8.2+, Composer, database, `.env`, `migrate`, `db:seed`, `storage:link`, and document root on `public_html`.
- **Admin:** Log in at **`/admin/login`** with **admin@training.com** / **admin123**, then change the password and configure Settings.

For technical or server-specific issues, refer to your developer or hosting provider.
