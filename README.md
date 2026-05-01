# 🍰 Piece of Cake Store
**Organization:** [Down-with-T-T-T](https://github.com/Down-with-T-T-T)  
**Course:** [CSCI 466 Databases]  

A fullstack e-commerce "Bake-End" application specializing inn cake inventory management and customer ordering.

---

## 👥 The Team
* **Kara Murphy**
* **Chris Bolosan** 
* **Sebastian Ibarra**
* **Bahar Safi**

## 📖 Project Documentation (Notion/Discord)
> **IMPORTANT:** Our primary project management, meeting notes, and live data to Notion and Discord .
> 🔗 **[Access the Notion Workspace Here](https://www.notion.so/339840ada25580c1a701de952eaf3a4f?v=339840ada25580fb905e000c076dca21&source=copy_link)**
> 🔗 **[Access the Discord Workspace Here](https://discord.gg/7jrKpvTs)**

---
## 🚀 Features

### 🛒 Storefront
- Browse cake catalog with inventory tracking
- Add to cart and checkout system
- Promo code support (ex:, `URMOM`)
- Order placement with confirmation

### 📦 Order Tracking
- Track orders using **Order ID + Email**
- View:
  - Order status (Processing, Shipped, Delivered)
  - Tracking number (for delivery orders)
  - Pickup readiness (for store pickup)
  - Order total + lifetime customer spending
- Visual progress bar for order status

### 🧑‍💼 Admin Panel
- View and manage all orders
- Update order status dynamically:
  - Delivery: Processing → Shipped → Delivered
  - Pickup: Processing → Ready → Delivered
- Auto-handling of tracking numbers (only when shipped)
- Dashboard analytics (Chart.js):
  - Orders over time
  - Revenue trends

### 📊 Data & Analytics
- Seeded dataset for realistic sales trends
- Revenue aggregation via SQL joins
---

## 📂 Project Structure
```text
gp-store/
├── docs/                   # design documents
├── database/               # SQL scripts (DDL + seed data)
│   ├── create_tables.sql
│   └── seed.sql
├── public/                 # web root 
│   ├── admin/              # admin panel (order management + dashboard)
│   │   ├── controllers/
│   │   ├── views/
│   │   └── index.php
│   ├── controllers/        # storefront controllers (business logic)
│   │   ├── home.php
│   │   ├── cart.php
│   │   ├── billing.php
│   │   ├── track.php
│   │   └── product.php
│   ├── views/              # storefront views (UI rendering)
│   │   ├── layout.php
│   │   ├── home.php
│   │   ├── cart.php
│   │   ├── billing.php
│   │   ├── track.php
│   │   └── product.php
│   ├── includes/           # Shared config (DB, helpers)
│   ├── css/                # Stylesheets
│   ├── images/             # Static assets
│   └── index.php           # Router / entry point
├── README.md
└── .gitignore
---
## 🧠 Architecture

This project follows a lightweight MVC-style structure:

- **Controllers** handle business logic and database interactions
- **Views** handle presentation and UI rendering
- **Layout** provides a shared template across pages


---

## 🗄️ Database Highlights

- Relational schema with foreign key constraints
- Key entities:
  - CUSTOMER
  - ORDERS (includes `OrderStatus`, `FulfillmentType`, `TrackingNumber`)
  - ORDER_ITEM
  - PAYMENT
  - DESTINATION
  - CAKE

### 🔄 Order Lifecycle
- **Delivery Orders:** Processing → Shipped → Delivered  
- **Pickup Orders:** Processing → Ready for Pickup → Delivered  

### 📦 Fulfillment Types
- `Delivery`
- `Pickup`

---
## 🔒 Data Integrity

- Checkout uses SQL transactions to ensure:
  - Orders are only created if payment + inventory updates succeed
  - Stock cannot go negative
  - Partial failures are rolled back
---

## 🌿 Git Workflow & Branching
To keep development organized and avoid merge conflicts:

- **main** → Stable, production-ready code (used for grading)  
- **dev** → Integration branch for completed features  
- **feature/[name]** → Individual work branches (ex: `feature/cart-system`)  

---

## 🔁 Workflow
# 1. Pull latest dev branch
- git checkout dev
- git pull origin dev

# 2. Create feature branch
- git checkout -b feature/your-feature-name

# 3. Work + commit changes
- git add .
- git commit -m "your message"

# 4. Push branch
- git push origin feature/your-feature-name

- Then open a Pull Request into dev.

📌 Notes
- All database credentials are injected securely via GitHub Secrets.
- The /public directory is the only deployed web root.
- Configuration files are auto generated during deployment and not stored in Git.

🛠️ Tech Stack
- PHP (Backend)
- MySQL (Database)
- GitHub Actions (CI/CD)
- Apache (Turing Server)
- HTML/CSS (Frontend)
- JavaScript (Client side interactivity)
- Chart.js (Data visualization)

🌐 Live Application Routes

🏪 Storefront Production URL 
https://students.cs.niu.edu/~z1405381/gp_store/public/?page=home

🛠️ Admin Dashboard
https://students.cs.niu.edu/~z1405381/gp_store/public/admin/?page=dashboard

🌐 Development ONLY Application Routes

🏪 Storefront Dev URL 
https://students.cs.niu.edu/~z1405381/gp_store_dev/public/?page=home

🛠️ Admin Dashboard Dev
https://students.cs.niu.edu/~z1405381/gp_store_dev/public/admin/?page=dashboard
