<?php
function get_pwned_passwords($prefix) {
    $url = "https://api.pwnedpasswords.com/range/" . strtoupper($prefix);
    $response = file_get_contents($url);

    if ($response === FALSE) {
        die("Error fetching data from HIBP API.");
    }

    return $response;
}

function check_password($prefix) {
    $breached_hashes = get_pwned_passwords($prefix);

    // Format response menjadi array
    $hash_list = explode("\n", $breached_hashes);

    // Buat output JSON
    $result = [];
    foreach ($hash_list as $line) {
        list($hash_suffix, $count) = explode(":", trim($line));
        $result[] = [
            "full_hash" => strtoupper($prefix . $hash_suffix),
            "breach_count" => intval($count)
        ];
    }

    return json_encode($result, JSON_PRETTY_PRINT);
}

// Ambil input dari parameter GET
if (isset($_GET['hash'])) {
    $hash_prefix = $_GET['hash'];

    // Validasi apakah hash terdiri dari 5 karakter heksadesimal
    if (!preg_match('/^[a-fA-F0-9]{5}$/', $hash_prefix)) {
        die(json_encode(["error" => "Invalid hash prefix. Must be exactly 5 hex characters."]));
    }

    // Cek hash di HIBP API
    header('Content-Type: application/json');
    echo check_password($hash_prefix);
} else {
    die(json_encode(["error" => "No hash prefix provided. Use ?hash=XXXXX"]));
}
?>
