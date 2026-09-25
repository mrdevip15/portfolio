<?php
/**
 * Post: Analyzing Critical Vulnerabilities in Sequelize ORM
 * Slug: sequelize-vuln
 */

return [
    'title' => 'Analyzing Critical Vulnerabilities in Sequelize ORM',
    'slug' => 'sequelize-vuln',
    'category' => 'Backend',
    'published_at' => '2026-03-20 14:30:00',
    'excerpt' => 'A deep dive into common pitfalls when using ORMs in production environments.',
    'content' => <<<HTML
<p>Object-Relational Mapping (ORM) tools are powerful, but they abstract away critical database interactions that can lead to security vulnerabilities if not handled with care. Sequelize, one of the most popular ORMs for Node.js, is no exception.</p>
<h2>The Risk of Raw Queries</h2>
<p>While Sequelize provides a raw query builder, developers often resort to raw queries for complex logic. This is where most SQL injection vulnerabilities creep in. Always use bind parameters.</p>
<h2>Improper Data Validation</h2>
<p>Never trust the ORM's built-in validation as your only line of defense. Always validate at the API entry point to ensure data integrity before it even reaches the database layer.</p>
HTML
];
