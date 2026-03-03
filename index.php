<?php
require __DIR__ . '/includes/header.php';
require_once __DIR__ . '/autoload.php';
use App\Service;

$services = [];
try {
    $services = Service::all();
} catch (Exception $e) {
    // If DB not available, leave services empty and optionally log
}
?>

<main class="container mt-5">
    <h1>Welcome to Our Digital Marketing Agency</h1>
    <p>We build brands, drive traffic, and grow businesses.</p>

    <section id="services" class="py-5">
        <div class="container">
            <h2 class="mb-4">Our Services</h2>
            <?php if (empty($services)): ?>
                <p class="text-muted">No services available at the moment.</p>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($services as $svc): ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($svc['title']); ?></h5>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($svc['description'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php';