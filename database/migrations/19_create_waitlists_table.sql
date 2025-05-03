create table waitlists
(
    id      int auto_increment
        primary key,
    id_user int                                 not null,
    made_on TIMESTAMP default CURRENT_TIMESTAMP not null,
    constraint waitlists_users_user_id_fk
        foreign key (id_user) references users (user_id)
);