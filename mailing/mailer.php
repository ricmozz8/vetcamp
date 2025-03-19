<?php
/**
 * Mailer class for sending emails.
 * 
 * This class provides methods for sending emails using different mailers.
 */

const REPLY_TO = 'VETCAMP UPRA '  .  '<' . 'vetcamp.arecibo@upr.edu' . '>';

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

        // // Configure the mailer service
        // ini_set('smtp', self::$mailer);
        // ini_set('smtp_host', self::$host);
        // ini_set('smtp_port', self::$port);
        // ini_set('smtp_username', self::$username);
        // ini_set('smtp_password', self::$password);




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
    public static function send($to, $subject, $message, $from = null): bool
    {
        self::init();

        if ($from === null) {
            $from = 'VETCAMP UPRA';
        }

        $headers = [
            'From: ' . $from,
            'Reply-To: ' . REPLY_TO,
        ];


        return mail($to, $subject, $message, implode("\r\n", $headers));
    }




}