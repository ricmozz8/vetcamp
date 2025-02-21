<?php
require_once 'Model.php';
require_once 'User.php';
require_once 'Comment.php';
require_once 'Tracking.php';

define('REQUIRED_DOCUMENTS_AMOUNT', 7);

class Application extends Model
{


    protected static $primary_key = 'id_application'; // Primary key
    protected static $table = 'applications'; // Table name

    public static $statusParsings = [
        'unsubmitted' => 'Sin subir',
        'submitted' => 'Sometida',
        'need_changes' => 'Necesita Cambios',
        'approved' => 'Aceptado',
        'denied' => 'Rechazado',
        'incomplete' => 'Incompleta',
        'waitlist' => 'En lista de espera'
    ];

    public $status;

    public function __construct(array $attributes, array $sanitized)
    {
        parent::__construct($attributes, $sanitized);
        $this->status = self::$statusParsings[$this->values['status']];
    }

    /**
     * Retrieves the user associated with the application.
     *
     * @return User The user that made the application.
     */
    public function user()
    {
        return User::find((int)$this->attributes['user_id'], 'user_id', 'users');
    }

    /**
     * Retrieves the preferred session of the application.
     *
     * If the second argument is true, the method will return a human-readable string
     * containing the title of the session and the start and end dates of the session.
     * If the second argument is false, the method will return an object of class Session.
     *
     * @param boolean $human_readable If true, returns a human-readable string. If false, returns a Session object.
     * @return string|Session Depending on the value of $human_readable.
     */
    public function preferred_session($human_readable = false)
    {

        $session = Session::find($this->attributes['id_preferred_session'], 'session_id');

        if ($human_readable) {
            return $session->title . ' (' . get_date_spanish($session->start_date, false, false) . ' al ' . get_date_spanish($session->end_date) . ')';
        }

        return $session;
    }

    /**
     * Gives all submitted documents.
     *
     * @return array An array of submitted documents.
     * @note: This will only return the URL of the documents that are submitted to the file system.
     */
    public function getSubmittedDocuments(): array
    {
        return remove_null_or_empty([
            'written_application' => $this->attributes['url_written_application'],
            'transcript' => $this->attributes['url_transcript'],
            'written_essay' => $this->attributes['url_written_essay'],
            'picture' => $this->attributes['url_picture'],
            'video_essay' => $this->attributes['url_video_essay'],
            'authorization_letter' => $this->attributes['url_authorization_letter'],
            'recommendation_letter' => $this->attributes['url_recommendation_letter']
        ]);
    }


    /**
     * Retrieves the raw contents of the profile picture.
     *
     * @return string The raw contents of the profile picture.
     */
    public function getProfilePicture()
    {
        return $this->getDocuments()['picture'] ?? null;
    }


    /**
     * Retrieves all submitted documents.
     *
     * The documents are returned in an array, where each key is the name of the document
     * and the value is an array with the following keys:
     * - contents: The contents of the file.
     * - name: The name of the file.
     * - size: The size of the file in bytes.
     * - type: The mime type of the file.
     *
     * @return array An array of submitted documents.
     */
    public function getDocuments(): array
    {
        $document_array = [];

        foreach ($this->getSubmittedDocuments() as $key => $value) {
            // getting the file 
            try {
                $file = Storage::get_metadata('private', $value);
            } catch (FileNotFoundException $e) {
                // remove the path from the Model
                $this->update([
                    'url_' . $key => '',
                    'status' => 'unsubmitted'
                ]);
                continue;
            }


            $document_array[$key] = [
                'contents' => $file['contents'],
                'name' => $file['name'],
                'size' => $file['size'],
                'type' => $file['type']
            ];
        }

        return $document_array;
    }


    /**
     * Gets the application comments
     * @return Comment[] An array of the comment models that belongs to the Application
     */
    public function comments()
    {

        try {
            return Comment::findAllBy(['application_id' => $this->id_application]);
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * Counts the number of documents uploaded by the user in the application.
     *
     * @return int The number of uploaded documents.
     */
    public function documentCount()
    {
        $count = 0;

        foreach ($this->attributes as $key => $value) {
            if (strpos($key, 'url') !== false and $value != null) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Given a status in Spanish, returns the corresponding status in English.
     *
     * @param string $statusInSpanish The status in Spanish.
     * @return string The status in English. If the status in Spanish is not found, returns the input string.
     */
    public static function getStatusInEnglish($statusInSpanish)
    {
        $reverseParsing = array_flip(self::$statusParsings);
        return $reverseParsing[$statusInSpanish] ?? $statusInSpanish;
    }


    /**
     * Determines if the application is complete.
     *
     * @return boolean True if the application is complete, false otherwise.
     *
     * An application is considered complete if it has all the required documents,
     * the user's birthdate is not null, the user has a school address, a postal
     * address, a physical address, and an id of the preferred session.
     */
    public function isComplete()
    {

        if ($this->documentCount() !== REQUIRED_DOCUMENTS_AMOUNT) {

            return false;
        }

        if ($this->user()->birthdate === null or $this->user()->birthdate === '0000-00-00') {

            return false;
        }

        if ($this->user()->school_address() === null) {

            return false;
        }

        if ($this->user()->postal_address() === null) {

            return false;
        }

        if ($this->user()->physical_address() === null) {

            return false;
        }

        if ($this->id_preferred_session === null) {

            return false;
        }

        if ($this->shirt_size === null) {

            return false;
        }

        return true;
    }


    /**
     * Deletes all denied user requests.
     *
     * @return array An array of user IDs of the users whose requests were deleted.
     */
    public static function UserisDeniedDeletion()
    {
        $users = User::allApplicants();
        $deletedApplications = [];

        foreach ($users as $user) {
            $application = $user->application();

            if ($application) {
                $statusInEnglish = self::getStatusInEnglish($application->status);
            }
            if ($statusInEnglish === 'denied') {
                $application->hard_delete();
                $deletedApplications[] = $user->user_id;
            }
        }

        return $deletedApplications;
    }

    /**
     * Deletes all user requests.
     *
     * @return array An array of user IDs of the users whose requests were deleted.
     */
    public static function DeletionOfAllApplications()
    {
        $users = User::allApplicants();
        $deletedApplications = [];

        foreach ($users as $user) {
            $application = $user->application();
            if ($application) {
                $application->hard_delete();
                $deletedApplications[] = $user->user_id;
            }
        }

        return $deletedApplications;
    }


    /**
     * Hard deletes the application.
     *
     * This removes all the documents from the storage and deletes the application from the database.
     *
     * @return bool True if the application was successfully deleted, false otherwise.
     */
    public function hard_delete()
    {
        $documents = $this->getSubmittedDocuments();

        foreach ($documents as $key => $value) {
            try {
                // remove it from the storage
                Storage::delete('private', $value);
            } catch (FileNotFoundException $e) {
                // log the error if the file is not found as a warning
                ErrorLog::log($e->getMessage(), $e->getFile(), $e->getTraceAsString(), 'warning');
                continue;
            }

        }

        // remove all evaluations for this application
        $evaluations = $this->tracking();

        foreach ($evaluations as $evaluation) {
            $evaluation->delete();
        }

        // remove any associated comments
        $comments = $this->comments();

        foreach ($comments as $comment) {
            $comment->delete();
        }

        // finally, delete the application record
        return $this->delete();

    }

    public function tracking(){

        try{
            return Tracking::findAllBy(['application_id' => $this->__get('id_application')]);
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }


    /**
     * Checks if the application is submitted.
     *
     * @return boolean True if the application is submitted, false otherwise.
     */
    public function isSubmitted()
    {
        return in_array($this->status, [
            'Sometida',
            'Necesita Cambios',
            'Aceptado',
            'Rechazado',
            'Incompleta',
            'En lista de espera'
        ]);
    }
}
