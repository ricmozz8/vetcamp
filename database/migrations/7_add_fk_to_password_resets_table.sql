alter table password_resets
    add constraint password_resets_users_user_id_fk
        foreign key (user_id) references users (user_id);
