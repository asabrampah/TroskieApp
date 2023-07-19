<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $recipient = "asabrampah@st.ug.edu.gh"; // Replace with your email address
  $subject = "New Message from Troskie Contact Form";
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Compose the email content
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message";

  // Set the email headers
  $headers = "From: $name <$email>";

  // Send the email
  if (mail($recipient, $subject, $email_content, $headers)) {
    echo "Thank you! Your message has been sent.";
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }
}
?>