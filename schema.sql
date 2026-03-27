/* START: MySQL Schema Initialization */

CREATE DATABASE IF NOT EXISTS journal_db;
USE journal_db;

/**
 * Users Table
 */
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    role ENUM('Author', 'Reviewer', 'Editor', 'Admin') DEFAULT 'Author',
    specialty_tags TEXT, -- Comma-separated tags (e.g., 'Oncology, AI')
    orcid_id VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/**
 * Manuscripts & State Machine
 */
CREATE TABLE IF NOT EXISTS manuscripts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    editor_id INT DEFAULT NULL,
    title TEXT NOT NULL,
    abstract TEXT,
    status ENUM(
        'Draft', 
        'Submitted', 
        'Technical_Check', 
        'With_Editor', 
        'Under_Review', 
        'Decision_Pending', 
        'Revision_Requested', 
        'Accepted', 
        'Rejected', 
        'Production'
    ) DEFAULT 'Draft',
    ethics_approval_number VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_manuscript_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/**
 * Submission Versions (Rev 1, Rev 2)
 */
CREATE TABLE IF NOT EXISTS submission_versions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    manuscript_id INT NOT NULL,
    version_number INT DEFAULT 1,
    file_path VARCHAR(512) NOT NULL,
    cover_letter TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (manuscript_id) REFERENCES manuscripts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/**
 * Audit Log for Sensitive Actions
 */
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    manuscript_id INT,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/**
 * Peer Review Table (Structured Evaluations)
 */
CREATE TABLE IF NOT EXISTS reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    manuscript_id INT NOT NULL,
    reviewer_id INT NOT NULL,
    invitation_token VARCHAR(64) UNIQUE,
    status ENUM('Pending', 'Accepted', 'Declined', 'Completed', 'Cancelled') DEFAULT 'Pending',
    score_originality TINYINT DEFAULT 0,
    score_methodology TINYINT DEFAULT 0,
    score_clinical_impact TINYINT DEFAULT 0,
    comments_to_author TEXT,
    comments_to_editor TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (manuscript_id) REFERENCES manuscripts(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewer_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* END: MySQL Schema Initialization */
