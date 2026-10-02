<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — OFFICIAL CATEGORIES ALLOWLIST
 * Master source of truth for the 40 official award categories (20 Individual, 20 Corporate).
 * Strictly mirrors assets/js/main.js.
 */

declare(strict_types=1);

if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit('Access Denied');
}

/**
 * 20 Official Individual Excellence Award Categories
 */
function getIndividualCategories(): array {
    return [
        // STAY WELL
        "INTECARE Preventive Health Leadership Award 2026",
        "INTECARE Community Health Leadership Award 2026",
        "INTECARE Wellness & Lifestyle Medicine Leadership Award 2026",
        "INTECARE Mental Wellbeing Advocacy Award 2026",
        "INTECARE Health Promotion Innovation Award 2026",

        // GET WELL
        "INTECARE Integrative Healthcare Professional Leadership Award 2026",
        "INTECARE Patient-Centred Care Leadership Award 2026",
        "INTECARE Evidence-Based Medicine Leadership Award 2026",
        "INTECARE Healthcare Innovation in Care Delivery Award 2026",
        "INTECARE Clinical Excellence Leadership Award 2026",

        // RECOVER WELL
        "INTECARE Rehabilitation Leadership Award 2026",
        "INTECARE Recovery & Functional Healthcare Leadership Award 2026",
        "INTECARE Integrated Recovery Care Leadership Award 2026",
        "INTECARE Mental Health Recovery Leadership Award 2026",
        "INTECARE Independent Living & Social Care Leadership Award 2026",

        // AGE WELL
        "INTECARE Healthy Ageing Advocacy Award 2026",
        "INTECARE Active Ageing Leadership Award 2026",
        "INTECARE Longevity & Lifestyle Innovation Award 2026",
        "INTECARE Age-Friendly Healthcare Leadership Award 2026",
        "INTECARE Excellence in Ageing & Quality of Life Leadership Award 2026"
    ];
}

/**
 * 20 Official Corporate Excellence Award Categories
 */
function getCorporateCategories(): array {
    return [
        // ORGANISATIONAL EXCELLENCE
        "INTECARE Healthcare Organisation Excellence Award 2026",
        "INTECARE Wellness Organisation Excellence Award 2026",
        "INTECARE Healthcare Brand Excellence Award 2026",
        "INTECARE Emerging Healthcare Enterprise Excellence Award 2026",
        "INTECARE Excellence in Healthcare Impact Award 2026",

        // INNOVATION & TRANSFORMATION
        "INTECARE Healthcare Innovation Excellence Award 2026",
        "INTECARE Digital Health Transformation Excellence Award 2026",
        "INTECARE Health Technology Excellence Award 2026",
        "INTECARE Integrative Healthcare Innovation Excellence Award 2026",
        "INTECARE Future of Healthcare Excellence Award 2026",

        // PEOPLE, WORKPLACE & COMMUNITY
        "INTECARE Employer of Choice – Healthcare & Wellness Excellence Award 2026",
        "INTECARE Healthcare Workforce Development Excellence Award 2026",
        "INTECARE Excellence in Employee Wellbeing Award 2026",
        "INTECARE Community Partnership Excellence Award 2026",
        "INTECARE Social Impact & Community Development Excellence Award 2026",

        // INDUSTRY, SUSTAINABILITY & ECOSYSTEM
        "INTECARE Sustainable Healthcare Excellence Award 2026",
        "INTECARE Healthcare Ecosystem Partnership Excellence Award 2026",
        "INTECARE Excellence in Healthcare Enterprise Development Award 2026",
        "INTECARE Healthcare Investment & Growth Excellence Award 2026",
        "INTECARE Outstanding Contribution to the Healthcare & Wellness Economy Award 2026"
    ];
}

/**
 * Validates nominee type ('individual' or 'corporate')
 */
function isValidNomineeType(string $type): bool {
    return in_array($type, ['individual', 'corporate'], true);
}

/**
 * Validates that a category belongs to the official allowlist for the given type
 */
function isValidCategory(string $type, string $category): bool {
    $category = trim($category);
    if ($category === '') {
        return false;
    }

    if ($type === 'individual') {
        return in_array($category, getIndividualCategories(), true);
    }

    if ($type === 'corporate') {
        return in_array($category, getCorporateCategories(), true);
    }

    return false;
}
