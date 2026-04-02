<?php
// questionaire/survey_config.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Defining the exact sequence of 35 questionnaire steps as requested.
 * 
 * Order:
 * - General Info (1-6)
 * - Thyroid Screening (7-13)
 * - Diabetes Risk (14-19)
 * - Blood Pressure (20-27)
 * - Vitamins Deficiency (28-34)
 * - Result (35)
 */
define('SURVEY_STEPS', [
    'age.php',
    'gender.php',
    'marriage-status.php',
    'bmi.php',
    'chronic-diseases.php',
    'diagnosed.php',
    'index.php',
    'heart-sweat.php',
    'fatigue.php',
    'temp-sensitivity.php',
    'skin-hair.php',
    'weight-change.php',
    'period-regularity.php',
    'age-diabetes.php',
    'diabetes-family.php',
    'physical-activity.php',
    'fruits-veg.php',
    'blood-pressure-meds.php',
    'high-blood-sugar.php',
    'blood-pressure-history.php',
    'age-40plus.php',
    'symptoms-check.php',
    'bmi-check-bp.php',
    'high-salt-foods.php',
    'smoking-shisha.php',
    'activity-150min.php',
    'diabetes-cholesterol.php',
    'vitamin-deficiency.php',
    'vitamin-diet.php',
    'vitamin-fatigue.php',
    'vitamin-hair.php',
    'vitamin-muscle.php',
    'vitamin-skin-nails.php',
    'vitamin-appetite.php',
    'results.php'
]);

/**
 * Helper to get current file position in the sequence.
 */
function getCurrentStepIndex() {
    $currentFile = basename($_SERVER['PHP_SELF']);
    $index = array_search($currentFile, SURVEY_STEPS);
    return ($index !== false) ? $index : 0;
}

/**
 * Get Next & Prev URLs dynamically.
 */
function getNextStepUrl() {
    $index = getCurrentStepIndex();
    if ($index < count(SURVEY_STEPS) - 1) {
        return SURVEY_STEPS[$index + 1];
    }
    return 'results.php';
}

function getPrevStepUrl() {
    $index = getCurrentStepIndex();
    if ($index > 0) {
        return SURVEY_STEPS[$index - 1];
    }
    return '../index.php'; // Back to home if first step
}

/**
 * Dynamic Progress Bar Logic.
 * Lights up 'ON' segments based on the current step position.
 */
function getProgressBarsHtml() {
    $totalBars = 10; // Default segments to display
    $index = getCurrentStepIndex();
    $totalSteps = count(SURVEY_STEPS);
    
    // Percentage-based fill
    $numOn = ceil((($index + 1) / $totalSteps) * $totalBars);
    
    $html = '<div class="bars">';
    for ($i = 0; $i < $totalBars; $i++) {
        $class = ($i < $numOn) ? 'on' : 'off';
        $html .= '<div class="bar ' . $class . '"></div>';
    }
    $html .= '</div>';
    
    return $html;
}

/**
 * Saves current page answer and redirects to the next page.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['survey_answer'])) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    $_SESSION['survey_responses'][$currentPage] = $_POST['survey_answer'];
    
    $nextUrl = getNextStepUrl();
    header("Location: " . $nextUrl);
    exit();
}
?>
