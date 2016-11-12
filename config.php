<?php

$intro = file_get_contents(__DIR__ . '/content/intro.md'); // The introductory text above the letter form
$body = file_get_contents(__DIR__ . '/content/body.md'); // The body of the letter

$recipient = [
  'name' => 'Some Bureaucrat', // The recipient's name (optional)
  'organization' => 'Vague Yet Menacing Government Agency', // The recipient's organization (optional)
  'address' => "123 Main Street\nAnytown, Province A1B 2C3", // Use \n for line breaks
];

$salutation = "To Whom It May Concern:"; // The salutation of the letter
$signature = "Sincerely,"; // The sign-off of the letter
$analytics = ''; // A Google Analytics code if you're into that (e.g. UA-123456-78)
