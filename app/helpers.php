<?php

function generateLikertNames($length, $asc)
{
    $data = [];

    switch ($length) {
        case 2:
            $data = ['No', 'Yes'];
            break;
        case 3:
            $data = ['No', "I don't know", 'Yes'];
            break;
        case 5:
            $data = ['Not at all', 'Slightly', 'Moderately', 'Very', 'Extremely'];
            break;
    }

    if (!$asc) {
        return array_reverse($data);
    }

    return $data;
}

function fetchLikertFace($length, $index, $asc)
{
    $item = generateLikertNames($length, $asc)[$index];

    $facesArray = [
        '<i class="text-3xl">😞</i>',
        '<i class="text-3xl">😟</i>',
        '<i class="text-3xl">😐</i>',
        '<i class="text-3xl">🙂</i>',
        '<i class="text-3xl">☺️</i>',
    ];

    switch ($item) {
        case 'No':
            return $facesArray[0];
            break;
        case 'Yes':
            return $facesArray[4];
            break;
        case "I don't know":
            return $facesArray[2];
            # code...
            break;
        case "Not at all":
            return $facesArray[0];
            break;
        case "Slightly":
            return $facesArray[1];
            # code...
            break;
        case "Moderately":
            return $facesArray[2];
            # code...
            break;
        case "Very":
            return $facesArray[3];
            break;
        case "Extremely":
            return $facesArray[4];
            break;
        default:
            # code...
            break;
    }
}
