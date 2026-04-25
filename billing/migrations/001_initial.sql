-- billing/migrations/001_initial.sql

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    invoice_no VARCHAR(50) NOT NULL UNIQUE,
    invoice_date DATE NOT NULL,
    due_date DATE NOT NULL,
    currency VARCHAR(10) DEFAULT 'Rp',
    tax_percent DECIMAL(5,2) DEFAULT 0.00,
    status ENUM('draft', 'sent', 'paid', 'cancelled') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE IF NOT EXISTS invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    description TEXT NOT NULL,
    qty DECIMAL(10,2) DEFAULT 1.00,
    price DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE
);

-- Insert default admin (password hash from index.php)
INSERT IGNORE INTO users (username, password_hash) VALUES ('admin', '$2y$10$y.AUrjWuXP37K5YDLFyTAeCzAYUrJuZb2AJ/N15PPBHqKp.bu/Al6');

-- Insert some default clients
INSERT IGNORE INTO clients (name, details) VALUES ('BRITS INDONESIA', 'Jl. Kendal Sari Barat No.17C, Tulusrejo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141');
