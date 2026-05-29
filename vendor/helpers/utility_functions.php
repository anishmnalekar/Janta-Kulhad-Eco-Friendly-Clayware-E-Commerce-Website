<?php
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function format_currency($amount) {
    return "₹" . number_format($amount, 2);
}
?>
