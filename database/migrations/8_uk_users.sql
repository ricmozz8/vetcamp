alter table users
    add constraint users_pk
        unique (email);

