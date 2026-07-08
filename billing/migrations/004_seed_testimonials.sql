-- billing/migrations/004_seed_testimonials.sql

INSERT IGNORE INTO testimonials (client_name, company_name, testimonial, image_path) VALUES 
('Brits Indonesia', 'Supercamp #1', 'What sets Digiserv.ID apart is their ability to handle sophisticated data requirements. They integrated a complex IRT algorithm that saved our team hundreds of hours.', 'img/testimoni-2.webp'),
('Agnes Gosali', 'Ruangguru', 'The OpenClaw AI Assistant built by Digiserv has been a game-changer for our team. It significantly speeds up our productivity by automating repetitive tasks.', 'img/testimoni-3.jpeg'),
('Naim Syahrir', 'Navinsco', 'Excellent work! Digiserv expertise handled our professional email setup and boosted our visibility with top-tier SEO strategies. A truly comprehensive digital partner.', 'img/testimoni-4.webp');
