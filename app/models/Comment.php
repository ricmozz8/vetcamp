<?php
require_once 'Model.php';
require_once 'User.php';

class Comment extends Model{

    // define your methods here
    protected static $table = 'comments';

    /**
     * Gets the user that created the comment
     * @return User|null Either the User model or null if the user on the table does not match any user
     */
    public function user(): ?Model
    {
        try{
            return User::find($this->user_id);
        } catch (ModelNotFoundException $notFound) {
            return null;
        }
    }

}