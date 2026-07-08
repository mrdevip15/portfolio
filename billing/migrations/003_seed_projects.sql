-- billing/migrations/003_seed_projects.sql

INSERT IGNORE INTO projects (title, description, image_path, tags, link) VALUES 
('NAV|INS CO', 'Corporate website for a navigation and insurance company. Clean, professional design with a focus on brand presence and user trust.', 'img/navins.png', 'Corporate, UI/UX', '#'),
('Brits Tryout', 'A comprehensive online examination and tryout platform for students. Developed with a focus on comprehensive web architecture.', 'img/brits.png', 'Vue.js, IRT Scoring', '#');
