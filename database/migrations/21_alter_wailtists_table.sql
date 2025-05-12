-- 1. Drop the existing foreign key constraint
ALTER TABLE waitlists
  DROP FOREIGN KEY waitlists_users_user_id_fk;

-- 2. Rename the column from id_user to user_id
ALTER TABLE waitlists
  CHANGE COLUMN id_user user_id INT NOT NULL;

-- 3. Re-create the foreign key on the new column name
ALTER TABLE waitlists
  ADD CONSTRAINT waitlists_users_user_id_fk
    FOREIGN KEY (user_id) REFERENCES users (user_id);
