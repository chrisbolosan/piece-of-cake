# 🍰 Piece of Cake

A full-stack e-commerce application for a fictional bakery — "the Bake-End" — specializing in cake ordering, inventory management, and order fulfillment. Built from scratch in PHP with a custom MVC architecture and a normalized MySQL schema.

> **Academic origin:** Built as the term project for **CSCI 466 (Databases)** at Northern Illinois University. See the [Academic Note](#-academic-note) before reusing.

---

## 📌 Overview

Piece of Cake is a two-sided application:

- **Storefront** — customers browse a cake catalog, add items to a cart, apply a promo code, and check out. Orders are written to the database inside a single SQL transaction so an order is never half-created.
- **Admin panel** — staff view and manage every order, advance order status through its lifecycle, and see revenue/volume analytics rendered with Chart.js.

There is no framework underneath it: the router, MVC layering, data access, and transaction handling are all hand-written against PDO, which was the point of the course.

---

## 🚀 Features

### Storefront
- Browse a cake catalog backed by live inventory (`NumInStock`)
- Cart stored in the PHP session
- Promo code support (15% off) applied at billing
- Checkout that creates the order, payment, customer, and destination records atomically
- Order confirmation with a generated Order ID

### Order Tracking
- Look up an order by **Order ID + email**
- See order status, tracking number (delivery), pickup readiness (pickup), order total, and lifetime customer spend
- Visual progress bar for the order lifecycle

### Admin Panel
- List and inspect all orders, customers, and payments
- Advance order status:
  - **Delivery:** Processing → Shipped → Delivered
  - **Pickup:** Processing → Ready for Pickup → Delivered
- Tracking numbers surfaced once an order ships
- Dashboard analytics (Chart.js): orders over time and revenue trends, aggregated with SQL joins over seeded data

---

## 🧰 Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (custom MVC, no framework) |
| Database | MySQL (accessed via PDO) |
| Frontend | HTML, CSS, JavaScript |
| Charts | Chart.js |
| Web server | Apache (NIU Turing/Hopper) |
| CI/CD | GitHub Actions |

---

## 🧠 Architecture

The app follows a lightweight **MVC** structure with a single front-controller router.

**Request flow:**

```
Browser
  → public/index.php            (front controller / router)
    → controllers/<page>.php    (business logic + PDO data access)
      → views/<page>.php        (presentation)
        → views/layout.php      (shared page shell)
  → HTML response
```

`public/index.php` reads `?page=` from the query string and dispatches to the matching controller (`?page=home` → `controllers/home.php`, etc.). The admin panel is a parallel router under `public/admin/`.

- **Controllers** hold business logic and talk to the database through prepared PDO statements.
- **Views** render HTML only.
- **Layout** provides the shared header/footer shell wrapped around every view.
- **`includes/config.php`** creates the PDO connection (git-ignored; see `config.sample.php`).

```
piece-of-cake/
├── database/               # SQL scripts
│   ├── schema.sql          # DDL (tables, keys, constraints)
│   └── seed.sql            # sample data
├── public/                 # web root (only this is deployed)
│   ├── index.php           # storefront router / entry point
│   ├── controllers/        # storefront business logic
│   ├── views/              # storefront presentation
│   ├── admin/              # admin panel (own router, controllers, views)
│   ├── includes/           # shared config (config.sample.php)
│   ├── css/ · images/ · uploads/
├── .github/workflows/      # GitHub Actions deploy pipelines
├── Makefile                # local DB setup/reset/seed helpers
└── README.md
```

---

## 🗄️ Database

A normalized relational schema (`database/schema.sql`) with foreign-key constraints throughout.

| Table | Purpose |
|---|---|
| `CUSTOMER` | Customer contact info (email is `UNIQUE`) |
| `CAKE` | Catalog items: flavor, size, frosting, price, stock, image |
| `PAYMENT` | Payment record — **stores only the card's last four digits** (`CardLastFour CHAR(4)`) |
| `DESTINATION` | Shipping/billing address |
| `ORDERS` | An order: links customer, payment, address; holds status, fulfillment type, tracking number |
| `ORDER_ITEM` | Line items (composite PK `OrderID + CakeID`, quantity, optional custom message/image) |
| `ADMINISTRATOR` | Admin accounts (see [Known Limitations](#-known-limitations)) |

### Order lifecycle (state machine)

```
                 ┌────────────┐
   Delivery →    │ Processing │ → Shipped → Delivered
                 └────────────┘
                 ┌────────────┐
   Pickup   →    │ Processing │ → Ready for Pickup → Delivered
                 └────────────┘
```

`FulfillmentType` (`Delivery` / `Pickup`) selects which path an order follows; `OrderStatus` records the current state.

---

## 🔒 Data Integrity

This was a database course, so correctness of the data layer was a primary goal:

- **SQL-injection safe.** Every query that touches user input uses **prepared/parameterized PDO statements** — no string-concatenated SQL anywhere in the request path.
- **Atomic checkout via SQL transactions.** Checkout wraps payment, customer, destination, order, line-item inserts, and stock decrements in a single `beginTransaction()` … `commit()`. Any failure triggers `rollBack()`, so an order is never partially written.
- **Stock can't go negative.** Inventory is decremented with a guarded update (`UPDATE CAKE SET NumInStock = NumInStock - ? WHERE CakeID = ? AND NumInStock >= ?`). If it affects zero rows, checkout throws and the whole transaction rolls back.
- **Minimal cardholder data.** Only the last four digits of a card are ever stored (`substr($cardnum, -4)`), never the full number.
- **Secrets stay out of git.** The real `config.php` is git-ignored; deploys generate it from GitHub Secrets. Only `config.sample.php` is committed.

---

## 👤 My Role

I was the **team lead and primary contributor** on this project (~307 of 433 commits). Beyond writing the bulk of the application — the router, MVC layering, checkout transaction logic, admin panel, and CI/CD pipeline — I mentored teammates on:

- **Git workflow** — branching (`main`/`dev`/`feature/*`), pull requests, and resolving merge conflicts
- **Relational schema design** — normalization, keys, and foreign-key constraints
- **The MVC pattern** — separating controllers, views, and shared layout

## 👥 Contributors

Built by a four-person team for CSCI 466:

- **Chris Bolosan** — team lead
- **Kara Murphy**
- **Sebastian Ibarra**
- **Bahar Safi**

The full commit history in this repository reflects each contributor's work.

---

## ⚠️ Known Limitations

This is coursework, published honestly — these are real gaps, several of which are being addressed as I harden the project:

- **Admin panel is unauthenticated.** `ADMINISTRATOR` has no password column yet and admin routes aren't protected. *(Session-based auth with `password_hash()` is planned.)*
- **Checkout hardcodes `FulfillmentType = 'Delivery'`.** The pickup path exists in the schema and admin flow but isn't selectable at checkout.
- **Returning customers can collide.** Checkout always inserts a new `CUSTOMER`, but `CUSTOMER.Email` is `UNIQUE`, so a repeat email fails the insert and rolls the order back. There is no customer lookup/dedup yet.
- **Limited input validation / no CSRF tokens.** Server-side validation and output escaping are minimal. *(Planned.)*
- **Error handling leaks detail.** Some failures use `die()` with the raw message instead of user-safe messages and server-side logging. *(Planned.)*

---

## 🖥️ Live Demo

Hosted on the NIU CS Apache server (may require the campus network and can be offline outside the course):

- **Storefront:** https://students.cs.niu.edu/~z1405381/gp_store/public/?page=home
- **Admin dashboard:** https://students.cs.niu.edu/~z1405381/gp_store/public/admin/?page=dashboard

> A container-based local demo (Docker) is planned so the app can be run anywhere with one command, independent of the NIU server.

---

## 📸 Screenshots

Screenshots live in [`docs/`](docs/). _(To be added.)_

| Storefront | Admin Dashboard |
|---|---|
| `docs/storefront.png` | `docs/admin-dashboard.png` |

---

## 🛠️ Running Locally

1. Copy the sample config and fill in your own database credentials:
   ```bash
   cp public/includes/config.sample.php public/includes/config.php
   ```
2. Create and seed the database (adjust the variables for your environment):
   ```bash
   make setup DB_NAME=piece_of_cake DB_USER=youruser DB_PASS=yourpass
   ```
   This runs `database/schema.sql` then `database/seed.sql`.
3. Serve the `public/` directory with PHP + MySQL (Apache, or `php -S localhost:8000 -t public`).

> A Docker + docker-compose setup (PHP + MySQL, one command) is on the roadmap.

---

## 🌿 Git Workflow

- **`main`** — stable, production-ready
- **`dev`** — integration branch for completed features
- **`feature/<name>`** — individual work branches, merged into `dev` via pull request

---

## 📄 License

Released under the [MIT License](LICENSE).

## 🎓 Academic Note

This project was originally submitted as coursework for CSCI 466 at Northern Illinois University. It is published with the consent of all team members and the instructor as a portfolio piece. **Please do not copy it, in whole or in part, for your own coursework** — doing so is an academic-integrity violation. You're welcome to read it, learn from it, and reach out with questions.
