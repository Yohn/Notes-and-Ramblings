---
created: 2024-10-20T06:06:28-04:00
modified: 2024-10-24T17:49:35-04:00
---

Good question. The 'self' keyword in Content Security Policy (CSP) directives does not automatically include subdomains. Let me clarify how 'self' works and how you can include subdomains if needed:

### 1. 'self' in CSP:

- **'self'** refers to the origin from which the protected document is being served, including the same scheme (protocol), hostname (domain), and port number.
- It does not include subdomains by default.

2. Including **subdomains**:
   - To include subdomains, you need to explicitly list them or use wildcards.

##### .htaccess file:

```apache
<IfModule mod_headers.c>
    # Define your CDN domains here
    SetEnv CDN_DOMAINS "cdn1.example.com cdn2.example.com cdn3.example.com"

    # Define your main domain and subdomains
    SetEnv MAIN_DOMAIN "example.com"

    # Content Security Policy (CSP)
    # Controls which resources the user agent is allowed to load for this page
    Header set Content-Security-Policy "default-src 'self' *.%{MAIN_DOMAIN}e; \
script-src 'self' *.%{MAIN_DOMAIN}e %{CDN_DOMAINS}e; \
style-src 'self' *.%{MAIN_DOMAIN}e %{CDN_DOMAINS}e 'unsafe-inline'; \
img-src 'self' *.%{MAIN_DOMAIN}e %{CDN_DOMAINS}e data:; \
font-src 'self' *.%{MAIN_DOMAIN}e %{CDN_DOMAINS}e; \
object-src 'none'; \
frame-ancestors 'none'; \
base-uri 'self'; \
connect-src 'self' *.%{MAIN_DOMAIN}e; \
form-action 'self' *.%{MAIN_DOMAIN}e; \
frame-src 'none'; \
media-src 'self' *.%{MAIN_DOMAIN}e %{CDN_DOMAINS}e;"

    # HTTP Strict Transport Security (HSTS)
    # Ensures the browser only uses HTTPS for future requests
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"

    # X-Frame-Options
    # Prevents clickjacking attacks by disabling iframes
    Header always set X-Frame-Options "DENY"

    # X-Content-Type-Options
    # Prevents MIME type sniffing
    Header always set X-Content-Type-Options "nosniff"

    # Referrer-Policy
    # Controls how much referrer information should be included with requests
    Header always set Referrer-Policy "no-referrer"

    # Permissions-Policy
    # Controls which browser features and APIs can be used in the browser
    Header always set Permissions-Policy "geolocation=(), camera=(), microphone=(), payment=(), usb=(), vr=(), speaker=(), ambient-light-sensor=(), accelerometer=(), gyroscope=(), magnetometer=()"

    # Cross-Origin-Resource-Policy
    # Prevents other websites from loading resources from your site
    Header always set Cross-Origin-Resource-Policy "cross-origin"

    # Cross-Origin-Opener-Policy
    # Controls how your page shares browsing context group with other pages
    Header always set Cross-Origin-Opener-Policy "same-origin"

    # Cross-Origin-Embedder-Policy
    # Prevents a document from loading any cross-origin resources that don't explicitly grant the document permission
    Header always set Cross-Origin-Embedder-Policy "require-corp"
</IfModule>

# Ensure HTTPS
# Redirects all HTTP requests to HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

##### in PHP:

```php
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; connect-src 'self'; form-action 'self'; frame-src 'none';");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer");
header("Permissions-Policy: geolocation=(), camera=(), microphone=(), payment=(), usb=(), vr=(), speaker=(), ambient-light-sensor=(), accelerometer=(), gyroscope=(), magnetometer=()");
header("Cross-Origin-Resource-Policy: same-origin");
header("Cross-Origin-Opener-Policy: same-origin");
header("Cross-Origin-Embedder-Policy: require-corp");

```

## Key changes and explanations:

#### 1. Main domain definition:

- We've added a `SetEnv MAIN_DOMAIN "example.com"` line. Replace "example.com" with your actual main domain.

#### 2. Subdomain inclusion:

- In each relevant CSP directive, we've added `*.%{MAIN_DOMAIN}e`. This allows resources from all subdomains of your main domain.
- The asterisk (`*`) is a wildcard that matches any subdomain.

#### 3. Flexibility:

- This setup allows resources from your main domain, all its subdomains, and the specified CDN domains.
- You can easily adjust which directives allow subdomains by adding or removing the `*.%{MAIN_DOMAIN}e` part.

## Important notes:

1. **Wildcard usage**: While `*.example.com` allows all subdomains, it doesn't include the apex domain (example.com). That's why we keep both 'self' and the wildcard.

2. **Security considerations:** Allowing all subdomains can potentially reduce security if you have subdomains that are not fully under your control. Only use this if you're confident in the security of all your subdomains.

3. **Specific subdomains**: If you only want to allow specific subdomains, you can list them explicitly instead of using a wildcard. For example: `Header set Content-Security-Policy "... script-src 'self' subdomain1.%{MAIN_DOMAIN}e subdomain2.%{MAIN_DOMAIN}e ..."`

4. **Protocol consideration**: This setup allows resources from subdomains regardless of protocol (http or https). If you want to enforce HTTPS, you should prepend `https:` to the domain specifications, like this: `https://*.%{MAIN_DOMAIN}e`.

Remember to replace "example.com" with your actual domain, and thoroughly test your website after implementing these changes to ensure all resources load correctly and no functionality is broken.
