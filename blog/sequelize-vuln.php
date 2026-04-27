<?php
$pageTitle = 'Sequelize Vulnerabilities Analysis | Portfolio Blog | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-3xl mx-auto px-6 py-24">
  <article>
    <div class="text-xs font-semibold tracking-widest text-brand-gray mb-6 uppercase">Backend // 2026.03.20</div>
    <h1 class="text-4xl font-semibold hero-title text-brand-black mb-12 md:text-6xl">Analyzing Critical Vulnerabilities in <span class="editorial-italic font-normal">Sequelize ORM.</span></h1>
    <p>Object-Relational Mapping (ORM) tools are powerful, but they abstract away critical database interactions that can lead to security vulnerabilities if not handled with care. Sequelize, one of the most popular ORMs for Node.js, is no exception.</p>
    <h2>The Risk of Raw Queries</h2>
    <p>While Sequelize provides a robust query builder, developers often resort to raw queries for complex logic. This is where most SQL injection vulnerabilities creep in. Always use bind parameters.</p>
    <h2>Improper Data Validation</h2>
    <p>Never trust the ORM's built-in validation as your only line of defense. Always validate at the API entry point to ensure data integrity before it even reaches the database layer.</p>
  </article>
</main>

<?php include '../includes/footer.php'; ?>
