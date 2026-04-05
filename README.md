# 🍰 Piece of Cake Store
**Organization:** [Down-with-T-T-T](https://github.com/Down-with-T-T-T)  
**Course:** [CSCI 466 Databases]  

A fullstack e-commerce "Bake-End" application specializing inn cake inventory management and customer ordering.

---

## 👥 The Team
* **Chris Bolosan** 
* **Sebastian Ibarra**
* **Kara Murphy**
* **Bahar Safi**

## 📖 Project Documentation (Notion/Discord)
> **IMPORTANT:** Our primary project management, meeting notes, and live data to Notion and Discord .
> 🔗 **[Access the Notion Workspace Here](https://www.notion.so/339840ada25580c1a701de952eaf3a4f?v=339840ada25580fb905e000c076dca21&source=copy_link)**
> 🔗 **[Access the Discord Workspace Here](https://discord.gg/SmUUhvEvDG)**

---

## 📂 Project Structure
```text
gp-store/
├── docs/                   # Static design docs 
│   ├── er_diagram.pdf      # Store Diagram
│   ├── schema.pdf          # Relational Schema Mapping
│   └── description.pdf     # Project Scope & Requirements
├── database/               # SQL Scripts
│   ├── create_tables.sql   # DDL: Run this first
│   └── seed_data.sql       # DML: Sample cake inventory & users
├── public/                 # WEB ROOT (Deploy to public_html)
│   ├── admin/              # Staff only portal (Order fulfillment)
│   ├── includes/           # Shared components (Header/Footer/DB/etc..)
│   └── [pages].php         # Customer facing storefront
├── src/                    # Backend logic classes 
├── assets/                 # Frontend static files (CSS/JS*optional*)
├── README.md               # Quick-start guide
└── .gitignore              # Files to ignore (db.php configs)
