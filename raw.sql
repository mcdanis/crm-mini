SET NAMES utf8mb4;
SET time_zone = '+00:00';

-- 1. users (system users / staff who use the CRM)
CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  full_name VARCHAR(150) NOT NULL,
  password_hash VARCHAR(255) NULL, -- if using local auth
  role VARCHAR(10) DEFAULT 'user',  -- e.g. admin, user, sales
  is_active TINYINT(1) DEFAULT 1,
  meta JSON DEFAULT NULL,           -- flexible metadata (preferences)
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. services (list of services / products)
CREATE TABLE services (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  description TEXT NULL,
  default_price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. customers (contacts)
CREATE TABLE customers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(200) NOT NULL,
  email VARCHAR(255) NULL,
  phone VARCHAR(50) NULL,
  birthday DATE NULL,
  company_name VARCHAR(255) NULL,
  address TEXT NULL,
  suburb VARCHAR(150) NULL,
  state VARCHAR(150) NULL,
  postcode VARCHAR(20) NULL,
  note TEXT NULL,
  source VARCHAR(100) NULL,         -- e.g. 'instagram','referral','google'
  tag_id BIGINT UNSIGNED NULL,
  total_orders INT UNSIGNED DEFAULT 0,    -- cached aggregates (optional)
  total_spent DECIMAL(14,2) DEFAULT 0.00, -- cached aggregate
  last_order_at DATETIME NULL,            -- cached
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME NULL,
  created_by BIGINT UNSIGNED NULL,
  INDEX (email),
  INDEX (phone),
  INDEX (company_name),
  CONSTRAINT fk_customers_created_by_users FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. orders
CREATE TABLE orders (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id BIGINT UNSIGNED NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'draft', -- e.g. draft, confirmed, in_progress, completed, cancelled
  order_date DATE NOT NULL,                    -- date of order
  note TEXT NULL,
  total_amount DECIMAL(14,2) NOT NULL DEFAULT 0.00, -- sum of order_items (after discounts/custom_price)
  total_paid DECIMAL(14,2) NOT NULL DEFAULT 0.00,
  status VARCHAR(50) NOT NULL DEFAULT 'draft', -- e.g. done, ongoing, failed, booked
  scheduled_at DATETIME NULL,                  -- optional service date/time
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME NULL,
  created_by BIGINT UNSIGNED NULL,
  INDEX (customer_id),
  INDEX (order_date),
  INDEX (status),
  CONSTRAINT fk_orders_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
  CONSTRAINT fk_orders_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. payments (tracks payments/receipts for orders)
CREATE TABLE payments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id BIGINT UNSIGNED NULL,
  payment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  amount DECIMAL(14,2) NOT NULL,
  payment_method VARCHAR(100) NULL,    -- cash, bank_transfer, card, etc
  reference VARCHAR(255) NULL,         -- trx id
  note TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_by BIGINT UNSIGNED NULL,
  INDEX (order_id),
  CONSTRAINT fk_payments_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE SET NULL,
  CONSTRAINT fk_payments_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. activities (contact interactions: call, email, chat, note)
CREATE TABLE activities (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id BIGINT UNSIGNED NULL,
  order_id BIGINT UNSIGNED NULL,
  activity_type VARCHAR(50) NOT NULL,  -- call, email, chat, note, meeting
  activity_subtype VARCHAR(100) NULL,  -- e.g. outbound_call, inbound_call, follow_up
  title VARCHAR(255) NULL,
  body TEXT NULL,
  occurred_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- when the activity happened
  created_by BIGINT UNSIGNED NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (customer_id),
  INDEX (order_id),
  INDEX (activity_type),
  CONSTRAINT fk_activities_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
  CONSTRAINT fk_activities_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE SET NULL,
  CONSTRAINT fk_activities_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. import_export_jobs (for import/export contact feature)
CREATE TABLE import_export_jobs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  job_type VARCHAR(20) NOT NULL, -- import | export
  file_path VARCHAR(500) NULL,    -- where uploaded/generated file stored
  status VARCHAR(50) NOT NULL DEFAULT 'pending', -- pending, processing, completed, failed
  total_rows INT NULL,
  processed_rows INT NULL DEFAULT 0,
  error_message TEXT NULL,
  initiated_by BIGINT UNSIGNED NULL,
  started_at DATETIME NULL,
  finished_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (job_type),
  CONSTRAINT fk_import_export_initiated_by FOREIGN KEY (initiated_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. recommendations (next best task for top customers)
CREATE TABLE recommendations (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id BIGINT UNSIGNED NOT NULL,
  recommendation_text TEXT NOT NULL,
  score FLOAT DEFAULT 0,           -- higher = better
  reason JSON DEFAULT NULL,        -- explanation or metrics used
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_by BIGINT UNSIGNED NULL,
  acted_on TINYINT(1) DEFAULT 0,
  acted_at DATETIME NULL,
  INDEX (customer_id),
  INDEX (score),
  CONSTRAINT fk_recommendations_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
  CONSTRAINT fk_recommendations_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. optional: customer_stats (materialized/cache table to speed dashboards)
CREATE TABLE customer_stats (
  customer_id BIGINT UNSIGNED PRIMARY KEY,
  total_orders INT UNSIGNED DEFAULT 0,
  total_spent DECIMAL(14,2) DEFAULT 0.00,
  last_order_at DATETIME NULL,
  avg_order_value DECIMAL(12,2) DEFAULT 0.00,
  retention_score FLOAT DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_customer_stats_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE customer_tags (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id BIGINT UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_customer_tags_customer FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
