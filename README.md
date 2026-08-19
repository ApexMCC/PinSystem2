# Developer Implementation Guide: Dynamic PIN Authentication & Branding System

This repository contains the architecture and specifications for building a multi-tenant, PIN-authenticated web application with dynamic rebranding and subdomain routing capabilities.

---

## 🎯 Developer Objectives

You are tasked with setting up and deploying a system that meets the following core requirements:

1. **Secure PIN Auth:** Validate user-entered PINs (maximum 4 digits) against salted `bcrypt` hashes. Plaintext PINs must never be stored in the database.
2. **Dynamic Rebranding & Routing:** Upon entering a valid PIN, the system must either fetch and render brand-specific themes (logo, primary color, layout configuration) or **redirect the user to a dedicated subdomain** configured for that specific brand.
3. **Global Admin Panel:** Secure admin endpoints using Firebase Auth Custom Claims (`admin: true`) to manage PINs, brand configurations, and custom subdomains.
4. **Editable Dashboard Template:** Support a JSON-driven or Markdown-driven template structure that allows administrators to easily update dashboard content for each brand.

---

## 🏗 System Architecture

```text
  [ Client Input (PIN) ]
           │
           ▼
  [ Express API Server ] ──(Verify PIN Hash)──► [ Firestore: /pins ]
           │                                          │
   (Fetch Brand Metadata)                             │
           │                                          ▼
           ├───────────────────────────────► [ Firestore: /brands ]
           │
           ├─── (If Subdomain Configured) ──► Redirect to [ https://{brand}.yourdomain.com ]
           │
           └─── (If In-App Configured) ────► Render Dynamic Dynamic Dashboard Layout
