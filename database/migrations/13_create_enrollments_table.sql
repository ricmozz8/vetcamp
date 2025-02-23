create table enrollments
(
    user_id    int                                 not null
        primary key,
    session_id int                                 not null,
    created_at TIMESTAMP default CURRENT_TIMESTAMP not null,
    constraint enrollments_sessions_session_id_fk
        foreign key (session_id) references sessions (session_id),
    constraint enrollments_users_user_id_fk
        foreign key (user_id) references users (user_id)
);

