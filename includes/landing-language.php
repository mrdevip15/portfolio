<?php

function is_indonesian_ip(string $ip): ?bool
{
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        return null;
    }

    $address = inet_pton($ip);
    $ipv4Prefix = str_repeat("\0", 10) . "\xff\xff";
    if (str_starts_with($address, $ipv4Prefix)) {
        $ip = inet_ntop(substr($address, 12));
    }
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_GLOBAL_RANGE)) {
        return null;
    }
    if (strlen($address) === 4) {
        $address = $ipv4Prefix . $address;
    }

    $path = __DIR__ . '/../content/geoip/indonesia.bin';
    $ranges = is_readable($path) ? fopen($path, 'rb') : false;
    if ($ranges === false) {
        return null;
    }

    try {
        // Each record contains the first and last IP of an inclusive range.
        $size = fstat($ranges)['size'] ?? 0;
        if ($size === 0 || $size % 32 !== 0) {
            return null;
        }

        $low = 0;
        $high = intdiv($size, 32) - 1;
        while ($low <= $high) {
            $middle = intdiv($low + $high, 2);
            if (fseek($ranges, $middle * 32) !== 0) {
                return null;
            }
            $range = fread($ranges, 32);
            if ($range === false || strlen($range) !== 32) {
                return null;
            }

            if (strcmp($address, substr($range, 0, 16)) < 0) {
                $high = $middle - 1;
            } elseif (strcmp($address, substr($range, 16)) > 0) {
                $low = $middle + 1;
            } else {
                return true;
            }
        }
        return false;
    } finally {
        fclose($ranges);
    }
}

function detect_landing_language(array $server, array $query = []): string
{
    // Explicit ?lang=id / ?lang=en wins, so ad links and reviewers always see the intended language.
    $requested = strtolower((string) ($query['lang'] ?? ''));
    if (in_array($requested, ['id', 'en'], true)) {
        return $requested;
    }

    $isIndonesian = is_indonesian_ip($server['REMOTE_ADDR'] ?? '');
    if ($isIndonesian !== null) {
        return $isIndonesian ? 'id' : 'en';
    }

    $bestLanguage = 'en';
    $bestWeight = 0.0;
    foreach (explode(',', $server['HTTP_ACCEPT_LANGUAGE'] ?? '') as $preference) {
        if (!preg_match('/^([a-z]{1,8})(?:-[a-z0-9]{1,8})*(?:\s*;\s*q=(0(?:\.\d{0,3})?|1(?:\.0{0,3})?))?$/i', trim($preference), $parts)) {
            continue;
        }
        $weight = (float) ($parts[2] ?? 1);
        if ($weight > $bestWeight) {
            $bestLanguage = strtolower($parts[1]);
            $bestWeight = $weight;
        }
    }

    return in_array($bestLanguage, ['id', 'in'], true) ? 'id' : 'en';
}

$landingLanguage = detect_landing_language($_SERVER, $_GET);
$landingText = static fn(string $en, string $id): string => $landingLanguage === 'id' ? $id : $en;

header('Content-Language: ' . $landingLanguage);
header('Vary: Accept-Language', false);
header('Cache-Control: private, no-store');
