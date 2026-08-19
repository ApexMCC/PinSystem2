# Developer Implementation Guide: Dynamic PIN Authentication & Branding System

This repository contains the architecture and specifications for building a multi-tenant, PIN-authenticated web application with dynamic rebranding capabilities.

---

## 🎯 Developer Objectives

You are tasked with setting up and deploying a system that meets the following core requirements:

1. **Secure PIN Auth:** Validate user-entered PINs (maximum 4 digits) against salted `bcrypt` hashes. Plaintext PINs must never be stored in the database.
2. **Dynamic Rebranding:** Upon entering a valid PIN, the system must fetch and render brand-specific themes (logo, primary color, layout configuration) without reloading the page.
3. **Global Admin Panel:** Secure admin endpoints using Firebase Auth Custom Claims (`admin: true`) to manage PINs and brand configurations.
4. **Editable Dashboard Template:** Support a JSON-driven or Markdown-driven template structure that allows administrators to easily update dashboard content for each brand.

---

## 🏗 System Architecture

```text
  [ Client (HTML/JS) ]
           │
           ▼
  [ Express API Server ] ──(Verify PIN Hash)──► [ Firestore: /pins ]
           │                                          │
   (Fetch Brand Theme)                                │
           │                                          ▼
           └───────────────────────────────► [ Firestore: /brands ]
