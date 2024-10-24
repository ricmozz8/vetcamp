<?php
/**
 * Mailer class for sending emails.
 * 
 * This class provides methods for sending emails using different mailers.
 */
class Mailer{

    // attributes
    private static $mailer;
    private static $host ;
    private static $port;
    private static $username;
    private static $password;
    private static $from;
    private static $to;



    private function __construct(){} // Avoid instantiation

    /**
     * Initializes the mailer configuration settings.
     *
     * This method retrieves the mailer settings such as mailer type, host, port,
     * username, password, and from address from the configuration and assigns them 
     * to the corresponding static properties.
     *
     * @return void
     */
    private static function init(): void
    {
        self::$mailer = get_config('mailing', 'mailer', 'smtp');
        self::$host = get_config('mailing', 'host', 'localhost');
        self::$port = get_config('mailing', 'port', '25');
        self::$username = get_config('mailing', 'username', '');
        self::$password = get_config('mailing', 'password', '');
        self::$from = get_config('mailing', 'from', '');
    }

    /**
     * Sends an email using the configured mailer settings.
     *
     * This method initializes the mailer configuration and sends an email
     * to the specified recipient with the given subject and message.
     *
     * @param string $to The recipient's email address.
     * @param string $subject The subject of the email.
     * @param string $message The body of the email.
     * 
     * @return bool Returns true if the email was successfully sent, otherwise false.
     */
    public static function send($to, $subject, $message): bool
    {
        self::init();
        return mail($to, $subject, $message);
    }




}