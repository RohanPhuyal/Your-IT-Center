<?php
// Calculate the total number of pages
$totalPages = ceil($totalItems / 4); // Assuming you want 4 items per page

// Display pagination links
echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination justify-content-center">';
for ($i = 1; $i <= $totalPages; $i++) {
  echo '<li class="page-item"><a class="page-link" href="accessories.php?page=' . $i . '">' . $i . '</a></li>';
}
echo '</ul>';
echo '</nav>';
?>
