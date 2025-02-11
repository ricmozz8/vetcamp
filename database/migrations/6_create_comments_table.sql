create table comments
(
    id      INTEGER auto_increment
        primary key,
    user_id INTEGER                             not null,
    comment TEXT                                not null,
    made_on TIMESTAMP default CURRENT_TIMESTAMP not null,
    constraint comments_users_user_id_fk
        foreign key (user_id) references users (user_id)
);